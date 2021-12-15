<?php

declare(strict_types = 1);

namespace aoc2021\Day12;

final class Graph
{
    public array $edges = [];
    public array $paths = [];
    public string $small = '';

    public static function create(string $input): Graph
    {
        $edges = explode("\n", $input);
        $graph = new self();
        foreach ($edges as $edge) {
            $rawEdge = explode('-', $edge);
            if (!in_array('start', $rawEdge, true)
                && !in_array('end', $rawEdge, true)) {
                $graph->addEdge(
                    new Edge(
                        new Vertex($rawEdge[0]),
                        new Vertex($rawEdge[1])
                    ));
                $graph->addEdge(
                    new Edge(
                        new Vertex($rawEdge[1]),
                        new Vertex($rawEdge[0])
                    ));
            } else {
                $sorted = $graph->sort($rawEdge);
                $graph->addEdge(
                    new Edge(
                        new Vertex($sorted[0]),
                        new Vertex($sorted[1])
                    ));
            }
        }

        return $graph;
    }

    private function addEdge(Edge $edge): void
    {
        $this->edges[] = $edge;
    }

    public function getAllPaths(): array
    {
        foreach ($this->edges as $edge) {
            if ($edge->isStart()) {
                $this->dfs($edge->end, [$edge->start->name]);
            }
        }

    #    var_dump($this->paths);
        return $this->paths;
    }

    private function dfs(Vertex $v, array $path): void
    {
        if ($v->getVisited() === true) {
            return;
        }

        $v->setVisited(true);
        $path[] = $v->name;

        if ($v->isEnd()) {
            $v->setVisited(false);
            $this->paths[] = $path;
            return;
        }
        foreach ($this->getNeighbors($v) as $neighborEdge) {
            if ($this->satisfiesFirstCriteria($neighborEdge->end, $path)) {
                $neighborEdge->start->setVisited(true);

                $this->dfs($neighborEdge->end, $path);
                if (($key = array_search($neighborEdge->end->name, $path, true)) !== false) {
                    unset($path[$key]);
                }
                $neighborEdge->start->setVisited(false);
                $neighborEdge->end->setVisited(false);
            }
        }
    }

    private function getNeighbors(Vertex $vertex): array
    {
        $neighbors = [];
        foreach ($this->edges as $edge) {
            if ($edge->start->name === $vertex->name) {
                $neighbors[] = $edge;
            }
        }

        return $neighbors;
    }

    private function satisfiesFirstCriteria(Vertex $vertex, array $path): bool
    {
        return !($vertex->isSmall() && $this->isInPath($vertex->name, $path));
    }

    private function satisfiesSecondCriteria(Vertex $vertex, array $path): bool
    {
        if ($this->small === '' && $vertex->isSmall()) {
            $this->small = $vertex->name;
        }

        return !($vertex->isSmall() && $this->isInPathTwice($vertex->name, $path));
    }

    private function isInPath(string $vertexName, array $path): bool
    {
        return in_array($vertexName, $path, true);
    }

    private function isInPathTwice(string $vertexName, array $path): bool
    {
        if ($vertexName !== $this->small) {
            return in_array($vertexName, $path, true);
        }

        $counts = array_count_values($path);
        if (isset($counts[$vertexName])) {
            return $counts[$vertexName] >= 2;
        }

        return false;
    }

    public function sort(array $raw): array
    {
        $sorted = [];
        if ($raw[0] === 'start') {
            return $raw;
        }
        if ($raw[1] === 'start') {
            $sorted[0] = $raw[1];
            $sorted[1] = $raw[0];
            return $sorted;
        }
        if ($raw[0] === 'end') {
            $sorted[0] = $raw[1];
            $sorted[1] = $raw[0];
            return $sorted;
        }
        if ($raw[1] === 'end') {
            return $raw;
        }

        return $sorted;
    }
}
