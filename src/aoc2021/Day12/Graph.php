<?php

declare(strict_types = 1);

namespace aoc2021\Day12;

final class Graph
{
    public array $edges = [];
    public array $paths = [];
    public string $small = '';
    public string $flag = '';

    public static function create(string $input, string $flag): Graph
    {
        $edges = explode("\n", $input);
        $graph = new self();
        foreach ($edges as $edge) {
            $rawEdge = explode('-', $edge);
            if ($graph->isStartOrEnd($rawEdge)) {
                $sorted = $graph->sort($rawEdge);
                $graph->addEdge(
                    new Edge(
                        new Vertex($sorted[0]),
                        new Vertex($sorted[1])
                    ));
            } else {
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
            }
        }
        $graph->flag = $flag;

        return $graph;
    }

    private function isStartOrEnd(array $rawEdge): bool
    {
        return in_array('start', $rawEdge, true)
            && in_array('end', $rawEdge, true);
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
            if ($this->satisfiesCriteria($neighborEdge, $path)) {
                $neighborEdge->start->setVisited(true);

                $this->dfs($neighborEdge->end, $path);

                $this->popVertex($neighborEdge->end, $path);
                $neighborEdge->start->setVisited(false);
                $neighborEdge->end->setVisited(false);
            }
        }
    }

    private function popVertex(Vertex $v, array $path): void
    {
        if (($key = array_search($v->name, $path, true)) !== false) {
            unset($path[$key]);
        }
    }

    private function getNeighbors(Vertex $v): array
    {
        $neighbors = [];
        foreach ($this->edges as $edge) {
            if ($edge->start->name === $v->name) {
                $neighbors[] = $edge;
            }
        }

        return $neighbors;
    }

    private function satisfiesCriteria(Edge $e, array $path): bool
    {
        if ($this->flag === 'firstTask') {
            return !($e->end->isSmall() && $this->isInPath($e->end, $path));
        }
        // argh, brain hurts
        if ($this->small === '' && $e->end->isSmall()) {
            $this->small = $e->end->name;
        }

        return !($e->end->isSmall() && $this->isInPathTwice($e, $path));
    }

    private function isInPath(Vertex $v, array $path): bool
    {
        return in_array($v->name, $path, true);
    }

    private function isInPathTwice(Edge $e, array $path): bool
    {
        if ($e->end->name !== $this->small) {
            return in_array($e->end->name, $path, true);
        }

        $counts = array_count_values($path);
        if (isset($counts[$e->end->name])) {
            if ($counts[$e->end->name] < 2) {
                $e->end->setVisited(false);
                $e->start->setVisited(false);
                return false;
            }
            return $counts[$e->end->name] >= 2;
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
