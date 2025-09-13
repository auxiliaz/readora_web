<?php
// Script to create sample PDF files for testing

// Create storage directories if they don't exist
$storageDir = 'storage/app/public/books';
if (!file_exists($storageDir)) {
    mkdir($storageDir, 0755, true);
    echo "Created directory: " . $storageDir . "\n";
}

// Sample books data
$books = [
    'the-great-gatsby' => [
        'title' => 'The Great Gatsby',
        'author' => 'F. Scott Fitzgerald',
        'content' => 'In my younger and more vulnerable years my father gave me some advice that I\'ve carried with me ever since. "Whenever you feel like criticizing anyone," he told me, "just remember that all the people in this world haven\'t had the advantages that you\'ve had."'
    ],
    'dune' => [
        'title' => 'Dune',
        'author' => 'Frank Herbert',
        'content' => 'A beginning is the time for taking the most delicate care that the balances are correct. This every sister of the Bene Gesserit knows. To begin your study of the life of Muad\'Dib, then take care that you first place him in his time: born in the 57th year of the Padishah Emperor, Shaddam IV.'
    ],
    'atomic-habits' => [
        'title' => 'Atomic Habits',
        'author' => 'James Clear',
        'content' => 'Changes that seem small and unimportant at first will compound into remarkable results if you\'re willing to stick with them for years. We all deal with setbacks but in the long run, the quality of our lives often depends on the quality of our habits.'
    ]
];

// Create storage directory if it doesn't exist
$storageDir = 'storage/app/public/books';
if (!file_exists($storageDir)) {
    mkdir($storageDir, 0755, true);
}

// Function to create a basic PDF structure
function createBasicPdf($title, $author, $content) {
    $pdf = "%PDF-1.4\n";
    $pdf .= "1 0 obj\n<<\n/Type /Catalog\n/Pages 2 0 R\n>>\nendobj\n\n";
    $pdf .= "2 0 obj\n<<\n/Type /Pages\n/Kids [3 0 R 4 0 R 5 0 R]\n/Count 3\n>>\nendobj\n\n";
    
    // Page 1
    $content1 = "BT\n/F1 24 Tf\n50 750 Td\n(" . addslashes($title) . ") Tj\n";
    $content1 .= "/F1 16 Tf\n0 -30 Td\n(by " . addslashes($author) . ") Tj\n";
    $content1 .= "/F1 12 Tf\n0 -50 Td\n(" . addslashes(substr($content, 0, 200)) . "...) Tj\n";
    $content1 .= "0 -30 Td\n(This is a sample PDF for demonstration.) Tj\nET\n";
    
    $pdf .= "3 0 obj\n<<\n/Type /Page\n/Parent 2 0 R\n/MediaBox [0 0 612 792]\n/Contents 6 0 R\n/Resources <</Font <</F1 9 0 R>>>>\n>>\nendobj\n\n";
    
    // Page 2
    $content2 = "BT\n/F1 18 Tf\n50 750 Td\n(Chapter 1) Tj\n";
    $content2 .= "/F1 12 Tf\n0 -30 Td\n(This chapter contains sample content for testing) Tj\n";
    $content2 .= "0 -20 Td\n(the PDF reader functionality in Readora.) Tj\n";
    $content2 .= "0 -30 Td\n(You can add notes and highlights while reading.) Tj\nET\n";
    
    $pdf .= "4 0 obj\n<<\n/Type /Page\n/Parent 2 0 R\n/MediaBox [0 0 612 792]\n/Contents 7 0 R\n/Resources <</Font <</F1 9 0 R>>>>\n>>\nendobj\n\n";
    
    // Page 3
    $content3 = "BT\n/F1 18 Tf\n50 750 Td\n(Chapter 2) Tj\n";
    $content3 .= "/F1 12 Tf\n0 -30 Td\n(This is the second page of the sample PDF.) Tj\n";
    $content3 .= "0 -20 Td\n(The PDF reader supports multiple pages,) Tj\n";
    $content3 .= "0 -20 Td\n(zoom controls, and navigation features.) Tj\nET\n";
    
    $pdf .= "5 0 obj\n<<\n/Type /Page\n/Parent 2 0 R\n/MediaBox [0 0 612 792]\n/Contents 8 0 R\n/Resources <</Font <</F1 9 0 R>>>>\n>>\nendobj\n\n";
    
    // Content streams
    $pdf .= "6 0 obj\n<<\n/Length " . strlen($content1) . "\n>>\nstream\n" . $content1 . "endstream\nendobj\n\n";
    $pdf .= "7 0 obj\n<<\n/Length " . strlen($content2) . "\n>>\nstream\n" . $content2 . "endstream\nendobj\n\n";
    $pdf .= "8 0 obj\n<<\n/Length " . strlen($content3) . "\n>>\nstream\n" . $content3 . "endstream\nendobj\n\n";
    
    // Font
    $pdf .= "9 0 obj\n<<\n/Type /Font\n/Subtype /Type1\n/BaseFont /Helvetica\n>>\nendobj\n\n";
    
    // Cross-reference table
    $pdf .= "xref\n0 10\n0000000000 65535 f \n";
    $positions = [];
    $currentPos = 9; // Start after "%PDF-1.4\n"
    
    for ($i = 1; $i <= 9; $i++) {
        $positions[$i] = $currentPos;
        $pdf .= sprintf("%010d 00000 n \n", $currentPos);
        // Calculate approximate position (this is simplified)
        $currentPos += 100; // Rough estimate
    }
    
    $pdf .= "trailer\n<<\n/Size 10\n/Root 1 0 R\n>>\nstartxref\n" . strlen($pdf) . "\n%%EOF\n";
    
    return $pdf;
}

foreach ($books as $filename => $book) {
    $pdfContent = createBasicPdf($book['title'], $book['author'], $book['content']);
    $filePath = $storageDir . '/' . $filename . '.pdf';
    file_put_contents($filePath, $pdfContent);
    echo "Created: " . $filePath . "\n";
}

echo "Sample PDF files created successfully!\n";
?>
