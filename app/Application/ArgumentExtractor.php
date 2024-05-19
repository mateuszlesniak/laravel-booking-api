<?php

namespace App\Application;

use Illuminate\Http\Request;
use UnexpectedValueException;

trait ArgumentExtractor
{
    private const string WORD_SEPARATOR = '_';

    public function extractArgumentsToObject(Request $request, string $className): object
    {
        $object = new $className;

        if (!$object instanceof PayloadObject) {
            throw new UnexpectedValueException();
        }

        foreach ($request->all() as $parameterName => $value) {
            $setter = $this->createSetterFunction($parameterName);

            if (!method_exists($object, $setter)) {
                continue;
            }

            $object->$setter($value);
        }

        $object->validatePayload();

        return $object;
    }

    private function createSetterFunction(string $name): string
    {
        return 'set' . str_replace(
                self::WORD_SEPARATOR,
                '',
                ucwords($name, self::WORD_SEPARATOR)
            );
    }
}
