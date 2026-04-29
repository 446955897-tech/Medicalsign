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
<!doctype html>
<html lang="ar" dir="rtl"> <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تفاصيل العرض | <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="page-detail">
  <div class="container">
    <article class="card details-card" style="text-align:center">
      
      <img src="<?= $src ?>" class="card-img" style="width:200px; height:200px; object-fit:cover; border-radius:20px;" 
            onerror="this.src='../images/placeholder.png'">
      
      <h3 style="font-size:2rem; margin-top:20px;"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h3>
      
      <div style="text-align:right; background:#f9fbff; padding:20px; border-radius:15px; margin:20px 0;">
          <p class="desc" style="max-height:none; font-size:1.1rem; color:#444;">
            <?= nl2br(htmlspecialchars($desc, ENT_QUOTES, 'UTF-8')) ?>
          </p>
      </div>

      <?php if ($video !== ''): ?>
        <div style="margin:20px 0;">
          <a href="<?= htmlspecialchars($video, ENT_QUOTES, 'UTF-8') ?>" target="_blank" class="btn">
             🎥 مشاهدة فيديو توضيحي
          </a>
        </div>
      <?php endif; ?>

      <div style="margin-top:30px; border-top:1px solid #eee; padding-top:20px;">
        <a href="symptoms.php" class="btn btn-back">⬅️ الرجوع لقائمة الأعراض</a>
      </div>
      
    </article>
  </div>
</body>
</html>