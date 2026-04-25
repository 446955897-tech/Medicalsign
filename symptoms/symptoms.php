<?php
session_start(); 
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$current_lang = $_SESSION['lang'] ?? 'ar';
$dir = ($current_lang == 'ar') ? 'rtl' : 'ltr';
?>

<!DOCTYPE html>
<html lang="<?= $current_lang ?>" dir="<?= $dir ?>" >
<head>
    <meta charset="UTF-8">
    <title>استكشف الأعراض الطبية</title>
    <link rel="stylesheet" href="../CSS/style.css"> 
</head>
<body>

<div class="logo-top-corner">
    <a href="index.php">
        <img src="../images/logo.png" alt="MedicalSign">
    </a>
</div>

<div class="container">
    <div style="text-align: left; padding: 10px 0;">
        <?php if ($current_lang == 'ar'): ?>
            <a href="?lang=en" style="text-decoration:none; color:#3182ce; border:1px solid #3182ce; padding:5px 15px; border-radius:20px; font-size:14px; font-weight:bold;">English</a>
        <?php else: ?>
            <a href="?lang=ar" style="text-decoration:none; color:#3182ce; border:1px solid #3182ce; padding:5px 15px; border-radius:20px; font-size:14px; font-weight:bold;">العربية</a>
        <?php endif; ?>
    </div>

    <?php
    include '../database/db.php';
    
$heading = ($current_lang == 'ar') ? 'استكشف الأعراض الطبية' : 'Explore Medical Symptoms';
echo '<h2>' . $heading . '</h2>';


$placeholder = ($current_lang == 'ar') ? 'ابحث عن عرض…' : 'Search for symptoms...';
echo '<input type="search" id="searchbar" onkeyup="searchSymptoms()" placeholder="' . $placeholder . '">';
 echo '<div class="s_grid" id="cards" aria-live="polite">';

$res = mysqli_query($conn, "SELECT id, name_ar, name_en, description_ar, description_en, icon, video_url FROM symptoms ORDER BY created_at DESC, id DESC");

if (!$res) {
    die('<pre style="direction:ltr;background:#fee;border:1px solid #fbb;padding:10px">SQL ERROR: ' . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, 'UTF-8') . '</pre>');
}

if (mysqli_num_rows($res) === 0) {
    echo '<p class="empty">لا توجد أعراض مسجّلة حالياً.</p>';
} else {
    while ($row = mysqli_fetch_assoc($res)) {
       $title = ($current_lang == 'en' && !empty($row['name_en'])) ? $row['name_en'] : $row['name_ar'];
       $desc  = ($current_lang == 'en' && !empty($row['description_en'])) ? $row['description_en'] : $row['description_ar'];

        
        
        $emoji = "🔍"; 
        $checkName = $row['name_ar'];
        if (mb_strpos($checkName, 'صداع') !== false) $emoji = "🤕";
        elseif (mb_strpos($checkName, 'زكام') !== false) $emoji = "🤧";
        elseif (mb_strpos($checkName, 'كحة') !== false) $emoji = "😷";
        elseif (mb_strpos($checkName, 'حرارة') !== false) $emoji = "🤒";
        elseif (mb_strpos($checkName, 'ألم') !== false) $emoji = "😫";
        elseif (mb_strpos($checkName, 'غثيان') !== false) $emoji = "🤢";
        elseif (mb_strpos($checkName, 'قيء') !== false) $emoji = "🤮";

       
     $statusText = ($current_lang == 'ar') ? "معلومات عامة" : "General Info";
$statusStyle = ""; 

if (mb_strpos($desc, 'ألم') !== false || mb_strpos($title, 'ضيق') !== false) {
    $statusText = ($current_lang == 'ar') ? "يحتاج انتباه" : "Needs Attention";
    $statusStyle = "style='background:#fff5f5; color:#e53e3e;'"; 
}

        echo '<article class="card" data-title="'. htmlspecialchars(mb_strtolower($title), ENT_QUOTES, "UTF-8") .'">';
    
       
            echo '<div class="status-tag" '.$statusStyle.'>'.$statusText.'</div>';
            
           
            echo '<div class="card-img" style="display:flex; align-items:center; justify-content:center; font-size:45px; background:#f0f7ff; margin: 0 auto 15px; width:90px; height:90px; border-radius:50%;">';
            echo $emoji;
            echo '</div>';

            echo '<h3>'. htmlspecialchars($title, ENT_QUOTES, "UTF-8") .'</h3>';
            
          
            echo '<p class="desc">'. htmlspecialchars(mb_strimwidth($desc, 0, 100, "...", "UTF-8"), ENT_QUOTES, "UTF-8") .'</p>';
            
            
         $btnText = ($current_lang == 'ar') ? 'التفاصيل' : 'Details';
            echo '<div style="margin-top:12px">';
                echo '<a href="symptom-details.php?id='. (int)$row['id'] .'" class="btn">'. $btnText .'</a>';
            echo '</div>';
        echo '</article>';
    }
}

echo '    </div>';
echo '</div>';
?>

<script src="../JAVA S/script.js"></script>

</body>
</html>