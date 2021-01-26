<?php

namespace Helldar\EnvSync\Services;

final class Parser
{
    protected $raw;

    public function raw(string $content): self
    {
        $this->raw = $content;

        return $this;
    }

    public function get(): array
    {
        $rows = $this->rows($this->raw);

        return $this->keys($rows);
    }

    protected function rows(string $content): array
    {
        $content = str_replace("\r\n", "\n", $content);

        return explode("\n", $content);
    }

    protected function keys(array $rows): array
    {
        $items = [];

        foreach ($rows as $row) {
            if (empty($row)) {
                $items[] = '';

                continue;
            }

            [$key, $value] = explode('=', $row, 2);

            $items[$key] = $value;
        }

        return $items;
    }
}
