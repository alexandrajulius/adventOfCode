<?php

declare(strict_types = 1);

namespace aoc2022\Day07;

final class FileTreeStructure {

    private array $path = ['root'];
    private string $parent;
    private array $fileTree = ['root' => []];

    public function build(string $input): array
    {
        $rawLines = $this->getRawLines($input);

        foreach ($rawLines as $line) {
            if ($this->isCommand($line)) {
                if ($this->isCd($line)) {
                    $parent = $this->getDirNameFromCommand($line);
                    $this->parent = $parent === '/' ? 'root' : $parent;
                    if ($this->parent !== 'root') {
                        $this->path[] = $this->parent;
                    }
                }
                if ($this->isCdUp($line)) {
                    if ($this->path !== []) {
                        array_pop($this->path);
                        $this->parent = end($this->path);
                    }
                    continue;
                }
            } else {
                $this->fileTree[$this->pathToString($this->path)][] = $line;
            }
        }

        return $this->fileTree;
    }

    private function getRawLines(string $input): array
    {
        $removeLs = str_replace('$ ls', '', $input);
        $removeEmptyLines = preg_replace("/^[ \t]*[\r\n]+/m", '', $removeLs);
        return explode("\n", $removeEmptyLines);
    }

    private function isCommand(string $line): bool
    {
        return str_contains($line, '$');
    }

    private function isCd(string $line): bool
    {
        return str_contains($line, '$ cd') && !str_contains($line, '..');
    }

    private function isCdUp(string $line): bool
    {
        return str_contains($line, '..');
    }

    private function getDirNameFromCommand(string $element): string
    {
        if ($element === '$ cd /') {
            return 'root';
        }
        $dir = explode(' ', $element);
        return $dir[2];
    }

    private function pathToString(array $path): string
    {
        return str_replace('//', '/', implode('/', $path));

    }
}
