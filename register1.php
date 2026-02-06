<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Entrance Monitoring System</title>
  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
      color: #333;
      line-height: 1.6;
      margin-top: 4%;
    }

    .logo img {
      width: 70px;
      height: 70px;
      justify-content: center;
      align-items: center;
      margin-right: 15px;
      color: white;
    }

    main {
      display: flex;
      gap: 50px;
    }

    /* Main container */
    .container {
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: scroll;
      overflow-x: hidden;
      position: relative;
      height: 78vh;
      width: 40vw;
      justify-content: space-between;
      margin-top: 30px;
    }

    /* Header with toggle */
    .header {
      background: #1b5e20;
      /* Dark green */
      color: white;
      padding: 20px;
      text-align: center;
      position: relative;
    }

    .header h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .toggle-buttons {
      display: flex;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 25px;
      overflow: hidden;
      margin: 0 20px;
    }

    .toggle-btn {
      flex: 1;
      padding: 10px 20px;
      background: none;
      border: none;
      color: white;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .toggle-btn a {
      text-decoration: none;
      color: white;
      padding: 50px;

    }

    .toggle-btn.active {
      background: rgba(255, 255, 255, 0.2);
    }

    .toggle-btn:hover {
      background: rgba(255, 255, 255, 0.15);
    }

    /* Forms */
    .form-container {
      padding: 30px 20px 5px 20px;

    }

    .form-container.active {
      display: block;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: #1b5e20;
      /* Dark green */
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    input:focus {
      outline: none;
      border-color: #1b5e20;
      /* Dark green */
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background: #1b5e20;
      /* Dark green */
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
      margin-top: 10px;
    }

    .submit-btn:hover {
      background: #145a32;
      /* Slightly lighter dark green */
    }

    .submit-btn:disabled {
      background: #ccc;
      cursor: not-allowed;
    }

    /* Error messages */
    .error {
      color: #d32f2f;
      font-size: 14px;
      margin-top: 5px;
      display: none;
    }

    /* Link to toggle form */
    .toggle-link {
      text-align: center;
      margin-top: 20px;
      color: #1b5e20;
    }

    .toggle-link a {
      color: #1b5e20;
      text-decoration: none;
      font-weight: 600;
    }

    .toggle-link a:hover {
      text-decoration: underline;
    }

    .toggle {
      text-decoration: none;
      color: white;
      padding: 10px 110px;
    }

    #employee-register {
      display: none;
    }

    .reg {
      margin-top: 20px;
    }

    #reg-msg {
      text-align: center;

    }

    .site-header {
      font-size: 24px;
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      color: white;
      margin-bottom: 20px;
      display: block;
      text-decoration: none;
    }

    .description {
      margin-bottom: 20px;
      font-size: 16px;
      color: #333;
      max-width: 800px;
      text-align: left;
      margin-top: 120px;
      margin-left: 30px;
    }

    .researchers {
      display: flex;
      justify-content: center;
      margin: 40px 0;
      background-color: #095d2fff;
      padding: 5%;
      color: white;
      text-align: center;
      margin-top: 10%;
    }

    .researcherspic {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
    }

    .pic-container {
      width: 200px;
    }

    .researchers-container {
      display: flex;
      gap: 5rem;
      justify-content: space-evenly;
      flex-wrap: wrap;
    }

    #researchers {
      text-align: center;
    }

     .researchers-btn {
      background-color: #1b5e20;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 20px;
    }

    .researchers-btn:hover {
      background-color: #097738ff;
    }

    .researcher-name {
      margin-top: 10px;
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      width: 110%;
    }

    .researcher-contact {
      font-size: 15px;
      text-align: center;
      width: 110%;
    }
  </style>
</head>

<body>
    <main>
      <section class="description">
        <h1>LAGRO HIGH SCHOOL</h1>
        <h3>Entrance Monitoring System with QR Code Technology</h3>
        <p>
          This prototype takes aim at the issues of monitoring the entrances of schools in a way that is both secure and efficient.
          The prototype incorporates access by role, registration, and password recovery to ensure that all users can be included and
          have access to the system. The interface incorporates modern web technologies and responsive design. <br>
        </p>
        <br>
        <p>
          Our prototype was made to improve the safety and monitoring system at Lagro High School. Checking people manually at the gate
          can be slow and may have errors, so we created a QR code system to make it faster and more accurate this system helps track the
          entry and exit of students, teachers, staff, and visitors automatically. it also helps security personnel identify authorized
          people and prevent unauthorized access. Overall, The prototype shows how QR code technology can make school security easier,
          faster, and more organized.
    </p>

    <button class="researchers-btn" onclick="researchersbtn()">Researchers</button>
  </section>
  
  <section>
    <div class="container">
      <div class="header">
        <div class="logo">
          <img src="Logos/Lagro_High_School_logo.png" alt="" />
        </div>
        <h1>Lagro High School</h1>
        <div class="toggle-buttons">
          <button class="toggle-btn active" id="btn1" onclick="switch1()">Student</button>
          <button class="toggle-btn" id="btn2" onclick="switch2()">Employee</button>
        </div>
      </div>
      
      
      <div id="login-form" class="form-container">
        <!-- Student Register Form -->
        <form id="loginForm">
          <div id="student-register">
            
            <div class="form-group">
              <label for="studentLoginLRN">Learner's Reference Number (LRN)</label>
              <input type="text" id="studentLoginLRN" required />
              <div class="error" id="studentLoginLRN-Error"></div>
            </div>

            <div class="form-group">
              <label for="studentRegFname">First Name</label>
              <input type="text" id="studentRegFname" required />
            </div>
            <div class="form-group">
              <label for="studentRegMname">Middle Name</label>
              <input type="text" id="studentRegMname" />
            </div>
            <div class="form-group">
              <label for="studentRegLname">Last Name</label>
              <input type="text" id="studentRegLname" required />
            </div>
            <div class="form-group">
              <label for="studentRegSuffixname">Suffix Name</label>
              <input type="text" id="studentRegSuffixname" required />
            </div>
            
            <div class="form-group">
              <label for="studentLoginPword">Password</label>
              <input type="password" id="studentLoginPword" required />
              <div class="error" id="studentLoginPword-Error"></div>
            </div>
            
            <button type="submit" class="submit-btn" id="studentLogin-submit">Register</button>
            <div class="reg">
              <p id="reg-msg">Already have an account? <a href="login.php">Login</a></p>
            </div>
          </div>
          
          <!-- Employee Register Form -->
          <div id="employee-register">
            <div class="form-group">
              <label for="employeeLoginID">Employee ID</label>
              <input type="text" id="employeeLoginID" required />
              <div class="error" id="employeeLoginID-Error"></div>
            </div>
            <div class="form-group">
              <label for="employeeLoginPword">Password</label>
              <input type="password" id="employeeLoginPword" required />
              <div class="error" id="employeeLoginPword-Error"></div>
            </div>
            <button type="submit" class="submit-btn" id="employeeLogin-submit">Register</button>
            <div class="reg">
              <p id="reg-msg">Already have an account? <a href="login.php">Login</a></p>
            </div>
          </div>
        </form>
        <div class="toggle-link">
          </div>
        </div>
      </section>
    </main>
      <section class="researchers">
        <div class="researchers-container">
          <div class="pic-container">
            <img class="researcherspic" src="Pics/Sandro_Alegre_1x1.jpg" alt="Sandro Alegre">
            <h3 class="researcher-name">Sandro Alegre</h3>
            <p class="researcher-contact">sandroalegre57@gmail.com</p>
            <p class="researcher-contact">0991-721-2803</p>
            </div>

            <div class="pic-container">
            <img class="researcherspic" src="Pics/wiw.jpg" alt="Sandro Alegre">
            <h3 class="researcher-name">Cyruz Renz E. Arguilles</h3>
            <p class="researcher-contact">arguillescyruzechano@gmail.com</p>
            <p class="researcher-contact">0993-790-9324</p>
            </div>

            <div class="pic-container">
            <img class="researcherspic" src="Pics/wiw.jpg" alt="Sandro Alegre">
            <h3 class="researcher-name">Prince Ghavriel P. Dacara</h3>
            <p class="researcher-contact">princedacara0102@gmail.com</p>
            <p class="researcher-contact">0994-465-0029</p>
            </div>

            <div class="pic-container">
            <img class="researcherspic" src="Pics/wiw.jpg"alt="Sandro Alegre">
            <h3 class="researcher-name">Janniel Gill O. Lazo</h3>
            <p class="researcher-contact">jjlazo31@gmail.com</p>
            <p class="researcher-contact">0933-502-4014</p>
            </div>

            <div class="pic-container">
            <img class="researcherspic" src="Pics/Andrei_Santos.jpg" alt="Sandro Alegre">
            <h3 class="researcher-name">Andrei B. Santos</h3>
            <p class="researcher-contact">andreisantos241207@gmail.com</p>
            <p class="researcher-contact">0968-430-6616</p>
            </div>

            <div class="pic-container">
            <img class="researcherspic" src="Pics/Arianney_Facunla.jpg" alt="Sandro Alegre">
            <h3 class="researcher-name">Arianney Mae F. Facunla</h3>
            <p class="researcher-contact">arianneymae@gmail.com</p>
            <p class="researcher-contact">0970-813-9598</p>
            </div>
        </div>
      </section>
      
      <script>
        function switch1() {
      document.getElementById("student-register").style.display = "block";
      document.getElementById("btn1").classList.add("active");
      document.getElementById("employee-register").style.display = "none";
      document.getElementById("btn2").classList.remove("active");

    }

    function switch2() {
      document.getElementById("student-register").style.display = "none";
      document.getElementById("btn1").classList.remove("active");
      document.getElementById("employee-register").style.display = "block";
      document.getElementById("btn2").classList.add("active");
    }

    function researchersbtn() {
      const researchersSection = document.querySelector('.researchers');
      researchersSection.scrollIntoView({ behavior: 'smooth' });
    }
  </script>
</body>

</html>