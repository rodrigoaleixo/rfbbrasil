# RFBrasil

[![Maintainer](http://img.shields.io/badge/maintainer-@rodrigo_aleixo-blue.svg?style=flat-square)](https://x.com/rodrigo_aleixo)
[![Source Code](http://img.shields.io/badge/source-rodrigoaleixo/rfbrasil.svg?style=flat-square)](https://github.com/rodrigoaleixo/rfbrasil)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/rodrigoaleixo/rfbrasil.svg?style=flat-square)](https://packagist.org/packages/rodrigoaleixo/rfbrasil)
[![Latest Version](https://img.shields.io/github/release/rodrigoaleixo/rfbrasil.svg?style=flat-square)](https://github.com/rodrigoaleixo/rfbrasil/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/rodrigoaleixo/rfbrasil.svg?style=flat-square)](https://scrutinizer-ci.com/g/rodrigoaleixo/rfbrasil)
[![Quality Score](https://img.shields.io/scrutinizer/g/rodrigoaleixo/rfbrasil.svg?style=flat-square)](https://scrutinizer-ci.com/g/rodrigoaleixo/rfbrasil)
[![Total Downloads](https://img.shields.io/packagist/dt/rodrigoaleixo/rfbrasil.svg?style=flat-square)](https://packagist.org/packages/rodrigoaleixo/rfbrasil)

###### 
This is an independent component built to meet the need to read data from the Brazilian Federal Revenue Registration Form..

Este é um componente independente contruido para atender uma necessidade de leitura dos dados da Ficha Cadastral da Receita FEderal do Brasil



### Highlights

- Simple installation (Instalação simples)
- Abstraction of all API methods (Abstração de todos os métodos da API)
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)

## Installation

Uploader is available via Composer:

```bash
"rodrigoaleixo/rfbrasil": "^1.0"
```

or run

```bash
composer require rodrigoaleixo/rfbrasil
```

## Documentation

###### For details on how to use, see a sample folder in the component directory. In it you will have an example of use for each class. It works like this:

Para mais detalhes sobre como usar, veja uma pasta de exemplo no diretório do componente. Nela terá um exemplo de uso para cada classe. Ele funciona assim:

#### User endpoint:

```php
<?php

require __DIR__ . "/../vendor/autoload.php";

use RodrigoAleixo\RFBrasil\ReceitaFederal;

$pdf = new ReceitaFederal();
$pdf->openPDF("cartao.pdf");

$cnpj = $pdf->get_CNPJ();
echo $cnpj;
```

### Others


## Contributing

Please see [CONTRIBUTING](https://github.com/rodrigoaleixo/rfbrasil/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email meu@email.com.br instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para rodrigoaleixo@gmail.com em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Rodrigo Aleixo](https://github.com/rodrigoaleixo) (Developer)
- [Nuuki](https://github.com/rodrigoaleixo) (Team)
- [All Contributors](https://github.com/rodrigoaleixo/rfbrasil/contributors) (This Rock)

## License

The MIT License (MIT). Please see [License File](https://github.com/rodrigoaleixo/rfbrasil/LICENSE) for more information.