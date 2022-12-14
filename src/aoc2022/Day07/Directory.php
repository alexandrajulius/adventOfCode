<?php

declare(strict_types = 1);

namespace aoc2022\Day07;

final class Directory {

    private string $dirName;
    private  string $path;
    /** Directory[] */
    private array $dirs;
    private array $files;
        
    public function __construct(string $dirName, string $path, array $dirs, array $files)
    {
        $this->dirName = $dirName;
        $this->path = $path;
        $this->dirs = $dirs;
        $this->files = $files;
    }

    public function dirName(): string
    {
        return $this->dirName;
    }

    public function dirs(): array
    {
        return $this->dirs;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function getDir(string $path): ?Directory
    {
        if (empty($path)) {
            return $this;
        }
        $pathSegments = array_filter(explode('/', $path));

        $name = array_shift($pathSegments);
        foreach ($this->dirs as $dir) {
            if ($dir->dirName !== $name) {
                continue;
            }
            if (empty($pathSegments)) {
                return $dir;
            }
            
            $childDir = $dir->getDir(implode('/', $pathSegments));
            if ($childDir) {
                return $childDir;
            } 
            return null;
        }
        return null;
    }
   
    public function addDir(Directory $dir): void
    {
        $this->dirs[] = $dir;
    }

    public function files(): array
    {
        return $this->files;
    }

    public function addFile(File $file): void
    {
        $this->files[$file->name()] = $file;
    }

    public function getFile(string $fileName): File
    {
        return $this->files[$fileName];
    }

    public function getSizes(): array
    {            
        $nestedSizes = $this->searchTreeForSizes($this->dirs);

        return $this->flatten($nestedSizes);
    }

    private function searchTreeForSizes(array $tree): array 
    {
        $sizes = [];
        foreach ($tree as $dir) {
            $sizes[] = $dir->getSize();
            if (!empty($dir->dirs())) {
                $sizes[] = $this->searchTreeForSizes($dir->dirs());
            }
        }

        return $sizes;
    }

    public function getSize(): int
    {
        return $this->searchForSize($this->files, $this->dirs);
    }

    private function searchForSize(array $files, array $dirs): int
    {
        $size = 0;
        if (!empty($files)) {
            foreach ($files as $file) {
                $size += $file->size();
            }
        }

        if (!empty($dirs)) {
            foreach ($dirs as $dir) {
                if (!empty($dir->files())) {
                    $size += $this->searchForSize($dir->files(), $dir->dirs());
                }
            }
        }

        return $size;
    }

    private function flatten(array $array): array 
    {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }
}
