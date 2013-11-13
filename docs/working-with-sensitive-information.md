# Working with sensitive information

All sensitive information (credit card number, cvv, card owner name etc) should be passed directly to a payment gateway.
It is not allowed to store such information even temporally.
If you want to store it you have to do it according to [PCI SSC Data Security Standards](https://www.pcisecuritystandards.org/security_standards/).
It is very challenging task and it is out of scope of this chapter.
Here we describe some practise that helps you not to accidentally store sensitive info anywhere.

All info like credit cards have to wrapped to `SensitiveValue` class.

 ```php
<?php

$cardNumber = new SensitiveValue('theCreditCardNumber');

serialize($cardNumber);
//NULL

clone $cardNumber;
// exception

$cardNumber->erase();
// remove value forever.

$cardNumber->get();
// get sensitive value and erase it

$cardNumber->peek();
// get sensitive value but not erase it. use carefully

(string) $model['cardNumber'];
// empty string
```

All supported payments aware of this class and will handle it safely.

Back to [index](index.md).