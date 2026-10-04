<?php
/**
 * Sync struktur images ke avatars folder
 * Copy foto dari public/assets/struktur/ ke storage/app/public/avatars/
 * Update users.avatar agar konsisten menggunakan path avatars/
 */

$pdo = new PDO('mysql:host=127.0.0.1;dbname=laravel;charset=utf8mb4', 'root', '');
$publicPath = __DIR__ . '/public';
$avatarsDir = __DIR__ . '/storage/app/public/avatars';

if (!is_dir($avatarsDir)) {
    mkdir($avatarsDir, 0775, true);
}

$stmt = $pdo->query("SELECT id, name, avatar FROM users WHERE avatar IS NOT NULL AND avatar != ''");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$updated = 0;
$skipped = 0;
$errors = [];

foreach ($users as $user) {
    $avatar = $user['avatar'];

    // Sudah di avatars/ folder — skip
    if (str_starts_with($avatar, 'avatars/')) {
        echo "⏭ SKIP (sudah avatars): {$user['name']}\n";
        $skipped++;
        continue;
    }

    // Handle path: assets/struktur/... atau struktur/...
    if (str_starts_with($avatar, 'assets/struktur/')) {
        $srcFile = $publicPath . '/' . $avatar;
    } elseif (str_starts_with($avatar, 'struktur/')) {
        $srcFile = __DIR__ . '/storage/app/public/' . $avatar;
    } else {
        echo "❓ UNKNOWN path: {$user['name']} → {$avatar}\n";
        continue;
    }

    if (!file_exists($srcFile)) {
        $errors[] = "File tidak ditemukan untuk {$user['name']}: {$srcFile}";
        echo "❌ FILE NOT FOUND: {$srcFile}\n";
        continue;
    }

    // Buat nama file baru yang aman (no spaces/special chars)
    $ext = pathinfo($srcFile, PATHINFO_EXTENSION);
    $safeName = 'user_' . $user['id'] . '_' . preg_replace('/[^a-z0-9]/', '_', strtolower($user['name']));
    $safeName = preg_replace('/_+/', '_', $safeName);
    $newFilename = $safeName . '.' . $ext;
    $destFile = $avatarsDir . '/' . $newFilename;
    $newAvatarPath = 'avatars/' . $newFilename;

    // Copy file
    if (copy($srcFile, $destFile)) {
        // Update DB
        $upd = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $upd->execute([$newAvatarPath, $user['id']]);
        echo "✅ COPIED: {$user['name']} → {$newAvatarPath}\n";
        $updated++;
    } else {
        echo "❌ COPY FAILED: {$srcFile} → {$destFile}\n";
    }
}

// Tambah avatar untuk user yang belum punya tapi ada di strukturs
echo "\n--- Cek strukturs yang belum disync ke users ---\n";
$stmt2 = $pdo->query("
    SELECT u.id, u.name, s.image
    FROM users u
    JOIN strukturs s ON u.name = s.name
    WHERE (u.avatar IS NULL OR u.avatar = '')
      AND s.image IS NOT NULL AND s.image != ''
");
$unsynced = $stmt2->fetchAll(PDO::FETCH_ASSOC);

foreach ($unsynced as $row) {
    $image = $row['image'];
    if (str_starts_with($image, 'assets/struktur/')) {
        $srcFile = $publicPath . '/' . $image;
    } elseif (str_starts_with($image, 'struktur/')) {
        $srcFile = __DIR__ . '/storage/app/public/' . $image;
    } else {
        continue;
    }

    if (!file_exists($srcFile)) {
        echo "❌ Struktur image not found: {$srcFile}\n";
        continue;
    }

    $ext = pathinfo($srcFile, PATHINFO_EXTENSION);
    $safeName = 'user_' . $row['id'] . '_' . preg_replace('/[^a-z0-9]/', '_', strtolower($row['name']));
    $safeName = preg_replace('/_+/', '_', $safeName);
    $newFilename = $safeName . '.' . $ext;
    $destFile = $avatarsDir . '/' . $newFilename;
    $newAvatarPath = 'avatars/' . $newFilename;

    if (copy($srcFile, $destFile)) {
        $upd = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $upd->execute([$newAvatarPath, $row['id']]);
        echo "✅ SYNCED dari struktur: {$row['name']} → {$newAvatarPath}\n";
        $updated++;
    }
}

echo "\n=== SELESAI ===\n";
echo "Updated: {$updated}\n";
echo "Skipped: {$skipped}\n";
if ($errors) {
    echo "Errors:\n";
    foreach ($errors as $e) echo "  - $e\n";
}
