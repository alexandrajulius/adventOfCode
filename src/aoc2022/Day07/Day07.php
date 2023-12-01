<?php

declare(strict_types = 1);

namespace aoc2022\Day07;

final class Day07
{
    private array $treeStructure;
    private Directory $fileTree;

    public function __construct(string $input)
    {
        $this->treeStructure = (new FileTreeStructure())->build($input);
    }
    public function firstTask(): int
    {   
        $this->createFileTree();
        $dirSizes = $this->fileTree->getSizes();
      
        $underThreshold = [];
        foreach ($dirSizes as $dirSize) {
            if ($dirSize <= 100000) {
                $underThreshold[] = $dirSize;
            }
        }

        return array_sum($underThreshold);
    }

    public function secondTask(): int
    {   
        $this->createFileTree();
        $rootSize = $this->fileTree->getSize();

        $dirSizes = $this->fileTree->getSizes();
        $dirSizes[] = $rootSize;

        $leftSpace = 70000000 - $rootSize;
        $toRemove = 30000000 - $leftSpace;
var_dump($toRemove);
dump($dirSizes);
        $underThreshold = [];
        foreach ($dirSizes as $size) {
            if ($size > $toRemove) {
                $underThreshold[] = $size;
            }
        }
#dump($underThreshold);
        return min($underThreshold);
    }

    private function createFileTree(): void
    {
        $this->fileTree = new Directory('root', '', [], []);
        foreach ($this->treeStructure as $path => $content) {
            $path = substr($path, 4);
            $parentDir = $this->fileTree->getDir($path);
            foreach ($content as $contentItem) {
                if ($this->isDir($contentItem)) {
                    $parentDir->addDir(
                        new Directory($this->getDirNameFromList($contentItem), $path, [], [])
                    );
                } else {
                    $parentDir->addFile(
                        new File($this->getFileName($contentItem), $this->getFileSize($contentItem))
                    );
                }
            }
        }
    
    }
    
    private function getDirNameFromPath(string $path): string
    {
        if (!str_contains($path, '/')) {
            return $path;
        }
        $dirName = strrchr($path , '/');
        return str_replace('/', '', $dirName);
    }

    private function getParentPath(string $path): string
    {
        if ($path === 'root') {
            return '';
        }

        return substr($path, 0, strrpos($path, '/'));
    }

    private function isDir(string $element): bool
    {
        return str_contains($element, 'dir');   
    }

    private function getDirNameFromList(string $element): string
    {
        $dir = explode(' ', $element);
        return $dir[1];
    }

    private function getFileName(string $element): string
    {
        $file = explode(' ', $element);
        return $file[1];
    }

    private function getFileSize(string $element): int
    {
        $file = explode(' ', $element);
        return (int)$file[0];
    }

}
