<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" type="image/x-icon" href="../pics/logos/Lagro_High_School_logo.png">
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .page-title {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        .about-us {
            display: flex;
            margin: 0 60px;
        }

        .picture img {
            width: 550px;
            height: auto;
            margin: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
            font-size: 18px;
            line-height: 1.6;
            text-align: justify;
        }

        .researchers {
            display: flex;
            justify-content: center;
            flex-direction: column;
            margin-bottom: 50px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .researcherspic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .pic-container {
            width: 200px;
            text-align: center;
        }

        .researcher-name {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            width: 100%;
            box-sizing: border-box  ;
        }

        .researcher-contact {
            font-size: 15px;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include '../include/header.php'; ?>

    <main>
        <section class="page-title">
            <h1>LAGRO HIGH SCHOOL</h1>
            <h3>Entrance Monitoring System with QR Code Technology</h3>
        </section>

        <section class="about-us">
            <div class="picture">
                <img src="../Pics/Lagro_High_School_gate.jpg" alt="LHS_Gate">
            </div>

            <div class="main-content">
               <p>
                    This prototype takes aim at the issues of monitoring the entrances of schools in a way that is both secure and efficient.
                    The prototype incorporates access by role, registration, and password recovery to ensure that all users can be included and
                    have access to the system. The interface incorporates modern web technologies and responsive design.
                </p>
                <p>
                    Our prototype was made to improve the safety and monitoring system at Lagro High School. Checking people manually at the gate
                    can be slow and may have errors, so we created a QR code system to make it faster and more accurate this system helps track the
                    entry and exit of students, teachers, staff, and visitors automatically. it also helps security personnel identify authorized
                    people and prevent unauthorized access. Overall, The prototype shows how QR code technology can make school security easier,
                    faster, and more organized.
                </p> 
            </div>
        </section>  

        <section class="researchers">
            <div class="title">
                <h2>Our Research Team</h2>
            </div>

            <div class="container">
                <div class="pic-container">
                    <img class="researcherspic" src="../Pics/Sandro_Alegre_1x1.jpg" alt="Sandro Alegre">
                    <h3 class="researcher-name">Sandro Alegre</h3>
                    <p class="researcher-contact">sandroalegre57@gmail.com</p>
                    <p class="researcher-contact">0991-721-2803</p>
                </div>

                <div class="pic-container">
                    <img class="researcherspic" src="../Pics/wiw.jpg" alt="Cyruz Renz E. Arguilles">
                    <h3 class="researcher-name">Cyruz Renz E. Arguilles</h3>
                    <p class="researcher-contact">arguillescyruzechano@gmail.com</p>
                    <p class="researcher-contact">0993-790-9324</p>
                </div>

                <div class="pic-container">
                    <img class="researcherspic" src="../Pics/wiw.jpg" alt="Prince Ghavriel P. Dacara">
                    <h3 class="researcher-name">Prince Ghavriel P. Dacara</h3>
                    <p class="researcher-contact">princedacara0102@gmail.com</p>
                    <p class="researcher-contact">0994-465-0029</p>
                </div>

                <div class="pic-container">
                    <img class="researcherspic" src="../Pics/wiw.jpg" alt="Janniel Gill O. Lazo">
                    <h3 class="researcher-name">Janniel Gill O. Lazo</h3>
                    <p class="researcher-contact">jjlazo31@gmail.com</p>
                    <p class="researcher-contact">0933-502-4014</p>
                </div>

                <div class="pic-container">
                    <img class="researcherspic" src="../Pics/Andrei_Santos.jpg" alt="Andrei B. Santos">
                    <h3 class="researcher-name">Andrei B. Santos</h3>
                    <p class="researcher-contact">andreisantos241207@gmail.com</p>
                    <p class="researcher-contact">0968-430-6616</p>
                </div>

                <div class="pic-container">
                    <img class="researcherspic" src="../Pics/Arianney_Facunla.jpg" alt="Arianney Mae F. Facunla">
                    <h3 class="researcher-name">Arianney Mae F. Facunla</h3>
                    <p class="researcher-contact">arianneymae@gmail.com</p>
                    <p class="researcher-contact">0970-813-9598</p>
                </div>
            </div>
            
        </section>
    </main>

    <?php include '../include/footer.php'; ?>
</body>
</html>