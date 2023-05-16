<?php
declare(strict_types=1);

namespace App\Service;

class ImageService implements ImageServiceInterface
{
  const UPLOADS_PATH_USER = DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'user';
  const UPLOADS_PATH_PIZZA = DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'pizza';
  const ALLOWED_MIME_TYPES_MAP = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/webp' => '.webp',
  ];

  public function moveImageToUploads(array $fileInfo, string $type): ?string
  {
    if ($fileInfo['error'] === UPLOAD_ERR_NO_FILE) {
      return null;
    }

    $fileName = $fileInfo['name'];
    $srcPath = $fileInfo["tmp_name"];
    $fileType = mime_content_type($srcPath);
    //$fileType = $fileInfo['type'];
    $imageExt = self::ALLOWED_MIME_TYPES_MAP[$fileType] ?? null;

    if (!$imageExt) {
      throw new InvalidArgumentException("File '$fileName' has non-image type '$fileType'");
    }

    if ($type === 'user') {
      $destFileName = uniqid('user', true) . $imageExt;
    }
    if ($type === 'pizza') {
      $destFileName = uniqid('pizza', true) . $imageExt;
    }

    return $this->moveFileToUploads($fileInfo, $destFileName, $type);
  }

  private function getUploadPath(string $fileName, string $type): string
  {
    $upOne = realpath(__DIR__ . '/..');
    if ($type === 'user') {
      $uploadsPath = dirname(__DIR__, 2) . self::UPLOADS_PATH_USER;
    }
    if ($type === 'pizza') {
      $uploadsPath = dirname(__DIR__, 2) . self::UPLOADS_PATH_PIZZA;
    }

    if ($type === 'user' && (!$uploadsPath || !is_dir($uploadsPath))) {
      throw new RuntimeException('Invalid uploads path: ' . self::UPLOADS_PATH_USER);
    }
    if ($type==='pizza' && (!$uploadsPath || !is_dir($uploadsPath))) {
      throw new RuntimeException('Invalid uploads path: ' . self::UPLOADS_PATH_PIZZA);
    }

    return $uploadsPath . DIRECTORY_SEPARATOR . $fileName;
  }

  private function moveFileToUploads(array $fileInfo, string $destFileName, string $type): string
  {
    $fileName = $fileInfo['name'];
    $destPath = $this->getUploadPath($destFileName, $type);
    $srcPath = $fileInfo['tmp_name'];
    if (!@move_uploaded_file($srcPath, $destPath)) {
      throw new RuntimeException("Failed to upload file $fileName");
    }

    return $destFileName;
  }
}