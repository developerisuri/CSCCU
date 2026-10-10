<?php
require_once 'config.php';
require_once 'fpdf/fpdf.php';

$search_name = $_GET['customer_name'] ?? '';
$search_blno = $_GET['bl_no'] ?? '';
$result = [];

if (!empty($search_name) || !empty($search_blno)) {
    $sql = "SELECT cus_id, customer_name, shipper_name, destination, status, bl_no, email, created_at 
            FROM customer_orders 
            WHERE 1=1";

    if (!empty($search_name)) {
        $sql .= " AND customer_name LIKE '%" . $conn->real_escape_string($search_name) . "%'";
    }

    if (!empty($search_blno)) {
        $sql .= " AND bl_no LIKE '%" . $conn->real_escape_string($search_blno) . "%'";
    }

    $query = $conn->query($sql);

    if ($query && $query->num_rows > 0) {
        $result = $query->fetch_all(MYSQLI_ASSOC);
    } else {
        $message = "No records found for your search.";
    }
}

// Generate PDF when download button clicked
if (isset($_POST['download_pdf'])) {
    $pdf_sql = "SELECT cus_id, customer_name, shipper_name, destination, status, bl_no, email, created_at 
                FROM customer_orders WHERE 1=1";
    if (!empty($search_name)) {
        $pdf_sql .= " AND customer_name LIKE '%" . $conn->real_escape_string($search_name) . "%'";
    }
    if (!empty($search_blno)) {
        $pdf_sql .= " AND bl_no LIKE '%" . $conn->real_escape_string($search_blno) . "%'";
    }

    $pdf_query = $conn->query($pdf_sql);

    class PDF extends FPDF {
        // Header design
       function Header() {
    // Draw logo first
    if(file_exists('logo.png')){
        $this->Image('logo.png', 10, 8, 20); // X=10mm, Y=8mm, width=20mm
    }

     if(file_exists('watermark.png')){
                $this->Image('watermark.png', 50, 60, 200, 0, '', '', '', false, 300, '', false, false, 0, true);
            }

    // Then draw the header cell
    $this->SetFont('Arial', 'B', 18);
    $this->SetFillColor(0, 51, 102); // Navy background
    $this->SetTextColor(255, 215, 0); // Gold text
    $this->SetXY(35, 8); // Start text after the logo
$this->Cell(0, 15, 'CSC Shipping System - Order History', 0, 1, 'C', true);

    $this->Ln(4);
}


        // Footer design
        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 9);
            $this->SetTextColor(180, 180, 180);
            $this->Cell(0, 10, 'Generated on ' . date('Y-m-d H:i:s') . ' | Page ' . $this->PageNo(), 0, 0, 'C');
        }

        // Table header
        function TableHeader() {
            $this->SetFont('Arial', 'B', 11);
            $this->SetFillColor(255, 215, 0); // Gold header
            $this->SetTextColor(0, 0, 0);
            $headers = ['ID', 'Customer', 'Shipper', 'Destination', 'Status', 'B/L No', 'Email', 'Created At'];
            $widths = [15, 35, 35, 35, 25, 30, 55, 35];
            for ($i = 0; $i < count($headers); $i++) {
                $this->Cell($widths[$i], 10, $headers[$i], 1, 0, 'C', true);
            }
            $this->Ln();
        }

        // Table rows
        function TableRows($data) {
            $this->SetFont('Arial', '', 10);
            $fill = false;
            $this->SetDrawColor(230, 230, 230);
            foreach ($data as $row) {
                $this->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, 255);
                $this->Cell(15, 8, $row['cus_id'], 1, 0, 'C', true);
                $this->Cell(35, 8, substr($row['customer_name'], 0, 20), 1, 0, 'L', true);
                $this->Cell(35, 8, substr($row['shipper_name'], 0, 20), 1, 0, 'L', true);
                $this->Cell(35, 8, substr($row['destination'], 0, 20), 1, 0, 'L', true);
                $this->Cell(25, 8, $row['status'], 1, 0, 'C', true);
                $this->Cell(30, 8, $row['bl_no'], 1, 0, 'C', true);
                $this->Cell(55, 8, substr($row['email'], 0, 28), 1, 0, 'L', true);
                $this->Cell(35, 8, $row['created_at'], 1, 1, 'C', true);
                $fill = !$fill;
            }
        }
    }

    $pdf = new PDF('L', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->TableHeader();
    if ($pdf_query && $pdf_query->num_rows > 0) {
        $data = $pdf_query->fetch_all(MYSQLI_ASSOC);
        $pdf->TableRows($data);
    } else {
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'No records found for your search.', 0, 1, 'C');
    }

    $pdf->Output('D', 'Customer_Order_History.pdf');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Customer Order History</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  background: linear-gradient(135deg, #001f3f, #003366, #004c99);
  background-size: 400% 400%;
  animation: bgMove 15s ease infinite;
  min-height: 100vh;
  color: #fff;
  padding: 40px;
}

@keyframes bgMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

h1 {
  text-align: center;
  font-size: 2.5rem;
  color: #FFD700;
  text-shadow: 0 0 10px #FFD700, 0 0 20px #FFFF00;
  margin-bottom: 40px;
}

form.search-form {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
  flex-wrap: wrap;
  margin-bottom: 40px;
}

input {
  padding: 12px 15px;
  border-radius: 25px;
  border: none;
  outline: none;
  width: 240px;
  font-size: 1rem;
  background: rgba(255, 255, 255, 0.15);
  color: #fff;
  box-shadow: 0 0 10px rgba(255,255,0,0.4);
  transition: 0.3s;
}
input:focus {
  background: rgba(255,255,255,0.25);
  box-shadow: 0 0 15px #FFFF00;
}

button {
  padding: 12px 22px;
  border-radius: 25px;
  border: none;
  background: linear-gradient(90deg, #FFD700, #FFFF00);
  color: #000;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
  box-shadow: 0 0 10px #FFD700;
}
button:hover {
  transform: scale(1.05);
  box-shadow: 0 0 20px #FFFF00;
}

table {
  width: 100%;
  border-collapse: collapse;
  background: rgba(255,255,255,0.1);
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(255,255,0,0.3);
  backdrop-filter: blur(15px);
}

th, td {
  padding: 12px 15px;
  text-align: center;
  border-bottom: 1px solid rgba(255,255,255,0.2);
}

th {
  background: rgba(255, 255, 0, 0.9);
  color: #000;
  font-weight: 600;
}

tr:hover {
  background: rgba(255,255,0,0.1);
  transform: scale(1.01);
  transition: 0.2s;
}

.message {
  text-align: center;
  color: #ff5555;
  font-weight: bold;
  margin-top: 20px;
}

.pdf-btn {
  display: block;
  margin: 30px auto 0;
  background: linear-gradient(90deg, #00ffcc, #00ffff);
  color: #000;
  border: none;
  border-radius: 25px;
  padding: 12px 24px;
  font-weight: 600;
  cursor: pointer;
  box-shadow: 0 0 15px #00ffff;
  transition: 0.3s;
}
.pdf-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 0 25px #00ffcc;
}

footer {
  text-align: center;
  color: #00ffff;
  margin-top: 50px;
  font-size: 0.9em;
}
footer a {
  color: #FFD700;
  text-decoration: none;
  margin: 0 10px;
}
footer a:hover {
  text-shadow: 0 0 10px #FFD700;
}
</style>
</head>
<body>

<h1><i class="fas fa-box"></i> Customer Order History</h1>

<form method="get" class="search-form">
  <input type="text" name="customer_name" placeholder="Enter Customer Name" value="<?= htmlspecialchars($search_name) ?>">
  <input type="text" name="bl_no" placeholder="Enter B/L No" value="<?= htmlspecialchars($search_blno) ?>">
  <button type="submit"><i class="fas fa-search"></i> Search</button>
</form>

<?php if (isset($message)): ?>
  <p class="message"><?= $message ?></p>
<?php endif; ?>

<?php if (!empty($result)): ?>
<form method="post">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Shipper</th>
        <th>Destination</th>
        <th>Status</th>
        <th>B/L No</th>
        <th>Email</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row): ?>
        <tr>
          <td><?= $row['cus_id'] ?></td>
          <td><?= htmlspecialchars($row['customer_name']) ?></td>
          <td><?= htmlspecialchars($row['shipper_name']) ?></td>
          <td><?= htmlspecialchars($row['destination']) ?></td>
          <td><?= htmlspecialchars($row['status']) ?></td>
          <td><?= htmlspecialchars($row['bl_no']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['created_at']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <button type="submit" name="download_pdf" class="pdf-btn">
    <i class="fas fa-file-pdf"></i> Download as PDF
  </button>
</form>
<?php endif; ?>

<footer>
  &copy; 2025 CSC Shipping System | <a href="#">Privacy</a> | <a href="#">Support</a>
</footer>

</body>
</html>
