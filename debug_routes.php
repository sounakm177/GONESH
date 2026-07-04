<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/register', 'GET');
$request->setUserResolver(function() {
    return null;
});

try {
    $response = $kernel->handle($request);
    echo 'Status: ' . $response->getStatusCode() . PHP_EOL;
    $content = $response->getContent();
    echo 'Length: ' . strlen($content) . PHP_EOL;
    echo 'Title: ' . (preg_match('/<title>(.*?)<\/title>/i', $content, $m) ? $m[1] : 'not found') . PHP_EOL;
} catch (\Exception $e) {
    echo 'Error: ' . get_class($e) . ': ' . $e->getMessage() . PHP_EOL;
    echo 'Trace: ' . $e->getTraceAsString() . PHP_EOL;
}
