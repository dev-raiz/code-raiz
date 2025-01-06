<?php

namespace coderaiz\app\purephp\core;

class Data
{
    protected function validateData(array $params, array $requiredFields): void
    {
        $paramKeys = array_keys($params);

        foreach ($requiredFields as $key => $field) {
            if (in_array($key, $paramKeys) === false) {
                throw new \Exception('O parâmetro ' . $field['description'] . ' é obrigatório.', 400);
            }

            if (empty($params[$key]) === true) {
                throw new \Exception('O parâmetro ' . $field['description'] . ' não pode ser vazio.', 422);
            }

            if (CONTEXT === 'api' && $field['type'] === 'decimal' && is_float($params[$key]) === false) {
                throw new \Exception('O tipo do parâmetro ' . $field['description'] . ' é inválido.', 422);
            }
        }
    }
}
