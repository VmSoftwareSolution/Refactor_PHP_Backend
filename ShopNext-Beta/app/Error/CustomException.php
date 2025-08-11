<?php

class EmailRequiredException extends InvalidArgumentException {}
class InvalidEmailFormatException extends InvalidArgumentException {}

class PasswordRequiredException extends InvalidArgumentException {}
class WeakPasswordException extends InvalidArgumentException {}

class EmptyFieldException extends InvalidArgumentException {}
class NegativeValueException extends InvalidArgumentException {}
class InvalidIdException extends InvalidArgumentException {}
class NotFoundException extends InvalidArgumentException {}
class InvalidParameterException extends InvalidArgumentException {}

class AlreadyExistsException extends InvalidArgumentException {}
class MaxLengthExceededException extends InvalidArgumentException {}
class InvalidDataException extends InvalidArgumentException {}

class UnexcpectedErrorException extends RuntimeException {}
