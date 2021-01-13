********************************************************************************
*** SPLIT PRICE MODULE - READ ME (english)
********************************************************************************

*** Objectives

The purpose of this module is to show the user the price of the product in installments.

*** Version 1.0.0

What we have in this version:
- only the price of the last installment;
- possibility to display the information on the product page or in the catalog listing;
- possibility of including fees/taxes to the value of the installments;
- possibility to choose the total installments;
- possibility to display portions of the total price to be paid in the shopping cart;
- possibility to customize display location (using ID/Class CSS);
- possibility to customize presentation using CSS and JS;

*** Tested

Version: 2.4.1 Open

PHP: 7.3.9

Theme: LUMA

*** Install

Move the <SplitPrice> folder to the directory:
app/code/MarioSAM/ (create the directory if it doesn't exist)

At the command prompt, Magento installation directory, type:
$ bin/magento module:enable MarioSAM_SplitPrice
$ bin/magento setup:upgrade
$ bin/magento cache:clean

Access the Magento panel and navigate to:
Stores > [Settings] Configuration > Mario SAM > Split Price

********************************************************************************
*** MODULO SPLIT PRICE - LEIA ME (portugues)
********************************************************************************

*** Objetivos

Objetivo deste modulo é mostrar ao usuario o preço do produto de forma parcelada.

*** Versao 1.0.0 - https://mariosam.com.br/versao2/modulo-m2-parcelamento

O que temos nesta versao:
- apenas o preço da ultima parcela;
- possibilidade de exibir a informacao na pagina do produto ou na listagem de catalogo;
- possibilidade de incluir taxas/impostos ao valor das parcelas;
- possibilidade de escolher qual o total de parcelas;
- possibilidade de exibir parcelas do preço total a ser pago no carrinho de compras;
- possibilidade de customizar local de exibicao (usando ID/Class CSS);
- possibilidade de customizar apresentacao usando CSS e JS;

*** Testado

Versao: 2.4.1 Open

PHP: 7.3.9

Tema: LUMA

*** Instalacao

Mova a pasta <SplitPrice> para o diretorio:
app/code/MarioSAM/ (crie o diretorio se nao existir)

No prompt de comando, diretorio de instalacao do Magento, digite:
$ bin/magento module:enable MarioSAM_SplitPrice
$ bin/magento setup:upgrade
$ bin/magento cache:clean

Acesse o painel do Magento e navegue em:
Lojas > [Configuracao] Configuracoes > Mario SAM > Preço Parcelado