<?php

class EmailRequiredException extends InvalidArgumentException {}
class InvalidEmailFormatException extends InvalidArgumentException {}
class PasswordRequiredException extends InvalidArgumentException {}
class WeakPasswordException extends InvalidArgumentException {}
class EmptyFieldException extends InvalidArgumentException {}
class NegativeValueException extends InvalidArgumentException {}
