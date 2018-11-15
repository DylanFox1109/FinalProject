<h1>CSC 337 Final Project of Your Own Design<h1>
Specifications are ALWAYS Subject to Change
Final Team of 2 Project of Your Own Design

If you do a project of your own design without our approval or do this solo without our expressed written permission, your grade for the code in this project will be 0.
Must be enough functionality for a two-person, three-week project: about 36 hours each person
Must have a data base with at least 2 tables and at least one data base join
When logged in, additional features must become available
Uses all five languages--HTML, PHP, CSS, JavaScript, and SQL
<script> JavaScript </script> allowed in html pages
Uses style sheet(s), no internal styling
Must have a nice appearance with some layout (subjective)
SECURITY: Use salted hashed passwords, use PHP's
password_hash($pwd, PASSWORD_DEFAULT);
boolean password_verify($pwd, $hash) 
SECURITY: Use prepared statements with bindParam
     public function getGradesFor($studentName) { 
       $stmt = $this->DB->prepare ("Select * from grades where student_id = :studentName" );
       $stmt->bindParam ( 'studentName', $studentName ); 
SECURITY:  Use PHP's htmlspecialchars on all user input
       $text = htmlspecialchars($text); 