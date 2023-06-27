<?php

declare(strict_types=1);

namespace Sun\Epay\Mapper;

use Sun\Epay\Dto\RequestDto\RequestDtoInterface;
use Sun\Epay\Dto\ResponseDto\ResponseDtoInterface;
use Sun\Epay\Exceptions\InternalError;
use Symfony\Component\PropertyInfo\Extractor\ConstructorExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ArrayObjectMapper
{
    private Serializer $serializer;

    public function __construct()
    {
        $phpDocExtractor = new PhpDocExtractor();
        $extractor = new PropertyInfoExtractor(
            typeExtractors: [new ConstructorExtractor([$phpDocExtractor]), $phpDocExtractor]
        );
        $boolNormalizer = static function (bool|int|null $value, object|string $object): bool|int|null {
            if ($value === null) {
                return null;
            }
            if (is_object($object)) {
                return intval($value);
            }
            return boolval($value);
        };
        $amountNormalizer = static function (string|float|null $value, object|string $object): string|float|null {
            if ($value === null) {
                return null;
            }
            if (is_object($object) && is_float($value)) {
                return number_format($value, 2, ',', '');
            }
            if (is_string($object) && is_string($value)) {
                return floatval(str_replace(',', '.', $value));
            }
            return null;
        };
        $normalizers = [
            new DateTimeNormalizer(),
            new ObjectNormalizer(
                propertyTypeExtractor: $extractor,
                defaultContext: [
                    AbstractNormalizer::CALLBACKS => [
                        'isNameEditable' => $boolNormalizer,
                        'isAddressEditable' => $boolNormalizer,
                        'isAmountEditable' => $boolNormalizer,
                        'returnInvoiceUrl' => $boolNormalizer,
                        'amount' => $amountNormalizer,
                    ],
                ],
            ),
            new ArrayDenormalizer(),
        ];
        $this->serializer = new Serializer($normalizers);
    }

    public function serialize(RequestDtoInterface $model): array
    {
        try {
            $data = $this->serializer->normalize($model);
            if (!is_array($data)) {
                throw new InternalError('Model was not normalized');
            }
            return $data;
        } catch (ExceptionInterface $e) {
            throw new InternalError('Error normalize model to array', $e);
        }
    }

    /**
     * @param array $data
     * @param string $type
     * @return ResponseDtoInterface|ResponseDtoInterface[]
     */
    public function deserialize(array $data, string $type): ResponseDtoInterface|array
    {
        try {
            return $this->serializer->denormalize($data, $type, null, [
                AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => true,
                AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
            ]);
        } catch (ExceptionInterface $e) {
            throw new InternalError('Error denormalize array to model', $e);
        }
    }
}
