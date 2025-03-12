<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Projet PHP Simple</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
            line-height: 1.6;
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        h2 {
            color: #0066cc;
            margin-top: 30px;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .info-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Mon Projet PHP Simple</h1>
    
    <div class="info-box">
        <h2>Information PHP</h2>
        <p>Version de PHP : <span class="success"><?php echo phpversion(); ?></span></p>
    </div>

    <div class="info-box">
        <h2>Connexion à la base de données</h2>
        <?php
        // Dans un environnement Docker, 'db' est le nom du service MySQL dans docker-compose
        $host = 'db';
        $dbname = 'monsite';
        $user = 'user';
        $password = 'password';

        // Vérifier si l'extension PDO est installée
        if (!extension_loaded('pdo_mysql')) {
            echo '<p class="error">L\'extension PDO MySQL n\'est pas installée.</p>';
        } else {
            try {
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo '<p class="success">Connexion à MySQL réussie !</p>';
                
                // Exécuter une requête simple pour confirmer la connexion
                $stmt = $conn->query('SELECT VERSION() as version');
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo '<p>Version MySQL : <span class="success">' . $row['version'] . '</span></p>';
                
            } catch(PDOException $e) {
                echo '<p class="error">Erreur de connexion : ' . $e->getMessage() . '</p>';
                echo '<p>Vérifiez que :</p>';
                echo '<ul>';
                echo '<li>Le service MySQL est démarré</li>';
                echo '<li>Les identifiants de connexion sont corrects</li>';
                echo '<li>Le nom du serveur MySQL est bien "db" (nom du service dans docker-compose)</li>';
                echo '</ul>';
            }
        }
        ?>
    </div>

    <div class="info-box">
        <h2>Test d'exécution PHP</h2>
        <p>Date et heure actuelles : 
            <strong>
                <?php echo date('d/m/Y H:i:s'); ?>
            </strong>
        </p>
    </div>
    
    <div class="info-box">
        <h2>Extensions PHP installées</h2>
        <?php
        $extensions = ['pdo', 'pdo_mysql', 'mysqli', 'json', 'curl', 'gd', 'mbstring', 'xml', 'zip'];
        echo '<ul>';
        foreach ($extensions as $ext) {
            echo '<li>' . $ext . ': ';
            if (extension_loaded($ext)) {
                echo '<span class="success">Installée</span>';
            } else {
                echo '<span class="error">Non installée</span>';
            }
            echo '</li>';
        }
        echo '</ul>';
        ?>
    </div>
</body>
</html>