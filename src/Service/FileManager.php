<?php
// src/Service/FileUploader.php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileManager
{
    private $targetDirectory;   // Target could be a sub-directory of uploadsDirectory. Default: upload to uploadsDirectory.
    private $uploadsDirectory;  // uploadsDirectory is '%kernel.project_dir%/public/uploads' defined by config/services.yaml 
    private $slugger;

    public function __construct($uploadsDirectory, SluggerInterface $slugger)
    {
        $this->uploadsDirectory = $uploadsDirectory;
        $this->targetDirectory = $this->uploadsDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
            echo $e;
        }

        return $fileName;
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }

    public function setSubDirectory($subDir): void
    {
        $this->targetDirectory = $this->uploadsDirectory.'/'.$subDir ;
    }

    public function deleteFile(string $fileName): void
    {
        $filePath = $this->getTargetDirectory().'/'.$fileName;

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}