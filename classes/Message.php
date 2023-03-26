<?php

class Message
{
    const LIMIT_NAME = 3;
    const LIMIT_MESSAGE = 10;
    private $name;
    private $message;
    private $date;

    public static function fromJSON(string $json): Message
    {
        $data = json_decode($json, true);
        return new self($data['name'], $data['message'], new DateTime('@' . $data['date']));
    }

    function __construct(string $name, string $message, ?DateTime $date = null)
    {
        $this->name = $name;
        $this->message = $message;
        $this->date = $date ?: new DateTime();
    }

    public function isValid(): bool
    {
        return empty($this->getErrors());
    }

    public function getErrors(): array
    {
        $errors = [];
        if (strlen($this->name) < self::LIMIT_NAME) {
            $errors['name'] = 'nom trop court';
        }
        if (strlen($this->message) < self::LIMIT_MESSAGE) {
            $errors['message'] = 'message trop court';
        }
        return $errors;
    }

    public function toHTML()
    {
        $name = htmlentities($this->name);
        $this->date->setTimezone(new DateTimeZone('Europe/Paris'));
        $date = $this->date->format('d/m/Y à H:i');
        $message = htmlentities($this->message);
        return <<<HTML
        <p>
            <strong>{$name}</strong> <em>le {$date}</em><br>
            {$message}
        </p>
HTML;
    }

    public function toJSON(): string
    {
        return json_encode([
            'name' => $this->name,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }
}
