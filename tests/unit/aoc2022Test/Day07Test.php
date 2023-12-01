<?php

declare(strict_types = 1);

namespace Tests\unit\aoc2022Test;

use Generator;
use PHPUnit\Framework\TestCase;
use aoc2022\Day07\Day07;
use aoc2022\Day07\File;
use aoc2022\Day07\Directory;
use aoc2022\Day07\FileTreeStructure;

final class Day07Test extends TestCase
{
    /**
     * @dataProvider provideInputFirstTask
     */
    /*
    public function testFirstTask(string $input, int $expected): void
    {
        $actual = (new Day07($input))->firstTask();
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputFirstTask(): Generator
    {
        yield 'Dummy input' => [
            '$ cd /
$ ls
dir a
14848514 b.txt
8504156 c.dat
dir d
$ cd a
$ ls
dir e
29116 f
2557 g
62596 h.lst
$ cd e
$ ls
584 i
$ cd ..
$ cd ..
$ cd d
$ ls
4060174 j
8033020 d.log
5626152 d.ext
7214296 k',
            'expected' => 95437
        ];

        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day07.txt'),
            'expected' => 1447046
        ];
    }
*/
  /**
     * @dataProvider provideInputSecondTask
     */
    public function testSecondTask(string $input, int $expected): void
    {
        $actual = (new Day07($input))->secondTask();
    
        self::assertEquals($expected, $actual);
    }

    public function provideInputSecondTask(): Generator
    {
        yield 'Dummy input' => [
            '$ cd /
$ ls
dir a
14848514 b.txt
8504156 c.dat
dir d
$ cd a
$ ls
dir e
29116 f
2557 g
62596 h.lst
$ cd e
$ ls
584 i
$ cd ..
$ cd ..
$ cd d
$ ls
4060174 j
8033020 d.log
5626152 d.ext
7214296 k',
            'expected' => 24933642
        ];
/*
        yield 'Final input' => [
            'input' => file_get_contents('./tests/fixtures/aoc2022/day07.txt'),
            'expected' => 1447046
        ];
        */
    }


    /**
     * @dataProvider provideFileTreeInput
     */
    public function testFileTreeStructure(string $input, array $expected): void
    {
        $actual = (new FileTreeStructure())->build($input);;

        self::assertEquals($expected, $actual);
    }

    public function provideFileTreeInput(): Generator
    {
        yield 'Dummy input' => [
            '$ cd /
$ ls
dir a
14848514 b.txt
8504156 c.dat
dir d
$ cd a
$ ls
dir e
29116 f
2557 g
62596 h.lst
$ cd e
$ ls
584 i
$ cd ..
$ cd ..
$ cd d
$ ls
4060174 j
8033020 d.log
5626152 d.ext
7214296 k',
            'expected' => [
                'root' => ['dir a', '14848514 b.txt', '8504156 c.dat', 'dir d'],
                'root/a' => ['dir e', '29116 f', '2557 g', '62596 h.lst'],
                'root/a/e' => ['584 i'],
                'root/d' => ['4060174 j', '8033020 d.log', '5626152 d.ext', '7214296 k'],
            ]
        ];
    }

    public function testGetDir(): void
    {
        $fileTree = (new Directory('root', '', [
                    new Directory('a', 'root', [
                        new Directory('e', 'root/a/e', [], [new File('foo', 45)])
                    ], []),
                    new Directory('d', 'root/a', [], [new File('bar', 145), new File('foobar', 1145)])
                ], [new File('bar', 145)]));
    
        $actual = $fileTree->getDir('/d');
        self::assertEquals('d', $actual->dirName());
        $actual = $fileTree->getDir('/a/e');
        self::assertEquals('e', $actual->dirName());
    }
}


