<?php

declare(strict_types=1);

namespace App\Application;

use http\Exception\BadConversionException;
use Illuminate\Http\Request;

trait ArgumentExtractor
{
    private const string WORD_SEPARATOR = '_';

    public function extractArgumentsToObject(Request $request, string $className): object
    {
        if (!class_exists($className)) {
            throw new BadConversionException();
        }

        $object = new $className();

        $this->validateParameters($object, $request->all());
        $this->assignParameters($object, $request->all());

        return $object;
    }

    private function createSetterFunction(string $name): string
    {
        return 'set'.str_replace(
            self::WORD_SEPARATOR,
            '',
            ucwords($name, self::WORD_SEPARATOR)
        );
    }

    private function validateParameters(object $object, array $parameters): void
    {
        $reflectionClass = new \ReflectionClass($object);

        if (!$reflectionClass->implementsInterface(PayloadObject::class)) {
            throw new \UnexpectedValueException();
        }

        foreach ($object->getRequiredFields() as $requiredField) {
            if (!array_key_exists($requiredField, $parameters)) {
                throw new MissingParameterException();
            }

            $setter = $this->createSetterFunction($requiredField);

            if (!$reflectionClass->hasMethod($setter)) {
                throw new MissingImplementationException($reflectionClass->getName(), $setter);
            }
        }
    }

    private function assignParameters(object $object, array $parameters): void
    {
        $reflectionClass = new \ReflectionClass($object);

        foreach ($object->getRequiredFields() as $requiredField) {
            $setter = $this->createSetterFunction($requiredField);

            $reflectionParameters = $reflectionClass->getMethod($setter)->getParameters();

            foreach ($reflectionParameters as $reflectionParameter) {
                $parameter = $parameters[$requiredField];

                $parameterType = $reflectionParameter->getType();
                if ($parameterType->isBuiltin()) {
                    $object->$setter($this->castBuiltInType($parameterType->getName(), $parameters[$requiredField]));

                    continue;
                }

                if (!class_exists($parameterType->getName())) {
                    throw new \Exception('Currently not implemented');
                }

                $parameter = new ($parameterType->getName())($parameters[$requiredField]);
                $object->$setter($parameter);
            }
        }
    }

    private function castBuiltInType(string $type, mixed $value): mixed
    {
        switch ($type) {
            case 'array' :
                return (array) $value;
            case 'float' :
                return (float) $value;
            case 'bool' :
                return (bool) $value;
            case 'int' :
                return (int) $value;
            case 'string' :
                return (string) $value;
            default:
                throw new \Exception('Not implemented type');
        }
    }
}
