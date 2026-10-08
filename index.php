<?php
// 簡単なフォーム送信処理（サーバーサイド動作確認用）
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8') : '';
    if ($name !== '') {
        $message = "こんにちは、{$name} さん！PHPサーバー側で正常にリクエストを処理しました。";
    } else {
        $message = "名前を入力してください。";
    }
}

// サーバー情報取得
$phpVersion = phpversion();
$serverTime = date('Y-m-d H:i:s');
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'PHP Built-in Server / CLI';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Backend Test App</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen py-12 px-4 text-slate-800 flex items-center justify-center">

  <main class="max-w-md w-full bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6">
    <!-- ヘッダー -->
    <header class="border-b border-slate-100 pb-4 text-center">
      <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full uppercase tracking-wider">
        Backend Service
      </span>
      <h1 class="text-xl font-bold text-slate-900 mt-2">PHP 疎通テストアプリ</h1>
      <p class="text-xs text-slate-500 mt-1">PHPがサーバー上で正常に動作しているか確認する画面です。</p>
    </header>

    <!-- サーバー情報ステータスカード -->
    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 space-y-2 text-xs">
      <div class="flex justify-between">
        <span class="text-slate-500">稼働ステータス:</span>
        <span class="font-bold text-emerald-600 flex items-center gap-1">
          <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
          Running (OK)
        </span>
      </div>
      <div class="flex justify-between">
        <span class="text-slate-500">PHP バージョン:</span>
        <span class="font-mono text-slate-700"><?php echo $phpVersion; ?></span>
      </div>
      <div class="flex justify-between">
        <span class="text-slate-500">サーバー現在時刻:</span>
        <span class="font-mono text-slate-700"><?php echo $serverTime; ?></span>
      </div>
      <div class="flex justify-between truncate">
        <span class="text-slate-500">実行環境:</span>
        <span class="font-mono text-slate-700 truncate max-w-[180px]"><?php echo htmlspecialchars($serverSoftware); ?></span>
      </div>
    </div>

    <!-- フォーム送信テストエリア -->
    <section class="space-y-3">
      <h2 class="text-sm font-bold text-slate-700">POST通信テスト</h2>
      <?php if (!empty($message)): ?>
        <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg text-xs text-blue-800">
          <?php echo $message; ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="" class="space-y-3">
        <div>
          <label for="username" class="block text-xs font-medium text-slate-600 mb-1">お名前を入力</label>
          <input
            type="text"
            id="username"
            name="username"
            placeholder="例: 山田 太郎"
            required
            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >
        </div>
        <button
          type="submit"
          class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded-lg text-sm transition"
        >
          サーバーへ送信する
        </button>
      </form>
    </section>

    <!-- フッターリンク -->
    <footer class="pt-2 border-t border-slate-100 text-center">
      <a href="https://masanori-hue.github.io/Repository-name-portfolio/" class="text-xs text-slate-400 hover:text-slate-600 transition">
        ← ポートフォリオサイトへ戻る
      </a>
    </footer>
  </main>

</body>
</html>