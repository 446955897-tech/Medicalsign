<?php
include '../database/db.php'; 

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { die('مُعرّف غير صالح'); }

$q = mysqli_query($conn, "SELECT id, name_ar, description_ar, icon, video_url FROM symptoms WHERE id=$id LIMIT 1");
if (!$q) { die('SQL ERROR: '.htmlspecialchars(mysqli_error($conn))); }
$data = mysqli_fetch_assoc($q);
if (!$data) { die('العرض غير موجود'); }

$title = $data['name_ar'] ?? '';
$desc  = $data['description_ar'] ?? '';
$file  = trim((string)($data['icon'] ?? ''));
$clean_file = str_replace('icon/', '', $file); 
$src = ($file !== '') ? "../images/icon/" . $clean_file : "../images/placeholder.png";
$video = trim((string)($data['video_url'] ?? ''));
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل | <?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="symptoms-body">

   <div class="logo-top-container">
    <a href="index.php">
       <img src="../images/logo.png" alt="MedicalSign Logo" class="logo">
</a>
   </div>

    <div class="symp-container" style="margin-top: 100px;">
        <article class="symp-card" style="max-width: 800px; margin: 0 auto; min-height: auto; padding: 40px; display: flex; flex-direction: column; align-items: center;">
            
            <div class="details-img-wrapper" style="margin-bottom: 25px;">
                <img src="<?= $src ?>" alt="<?= htmlspecialchars($title) ?>" 
                     style="width: 250px; height: 250px; object-fit: cover; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);"
                     onerror="this.src='../images/placeholder.png'">
            </div>

            <h2 style="color: #1a508b; font-size: 2.5rem; margin-bottom: 20px; font-weight: 700;">
                <?= htmlspecialchars($title) ?>
            </h2>

            <div class="status-tag" style="margin-bottom: 25px; font-size: 1rem; padding: 8px 20px;">
                تفاصيل الحالة الطبية
            </div>

            <div class="description-content" style="background: #f0f7ff; padding: 30px; border-radius: 20px; width: 100%; text-align: justify; line-height: 1.8; color: #333; font-size: 1.1rem; border-right: 5px solid #4facfe;">
                <?= nl2br(htmlspecialchars($desc)) ?>
            </div>

            <div style="margin-top: 40px; display: flex; flex-direction: column; gap: 15px; width: 100%; align-items: center;">
                
                <?php if ($video !== ''): ?>
                    <a href="<?= htmlspecialchars($video) ?>" target="_blank" class="symp-btn" style="width: 280px; text-align: center; padding: 15px;">
                        🎥 مشاهدة فيديو توضيحي
                    </a>
                <?php endif; ?>

                <a href="symptoms.php" class="symp-btn btn-back" style="width: 280px; text-align: center; padding: 15px; background: #fff !important; border: 2px solid #fed7d7 !important;">
                    ⬅️ الرجوع لقائمة الأعراض
                </a>
            </div>

        </article>
    </div>

</body>
</html>