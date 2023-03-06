<?php

require_once __DIR__.'/../vendor/autoload.php';

use Groovey\Form\Form;

$form = new Form();

?>
<table border="0" cellpadding="10" cellspacing="5">
    <tr align="left">
        <th>Usage</th>
        <th>Output</th>
    </tr>
    <tr>
        <td>$form->text('test', 'hello');</td>
        <td><?= $form->text('test', 'hello'); ?></td>
    </tr>
    <tr>
        <td>$form->password('password')</td>
        <td><?= $form->password('password'); ?></td>
    </tr>
    <tr>
        <td>$form->email('name');</td>
        <td><?= $form->email('name'); ?></td>
    </tr>
    <tr>
        <td>$form->file('test');</td>
        <td><?= $form->file('test'); ?></td>
    </tr>
    <tr>
        <td>$form->checkbox('name', 'value');</td>
        <td><?= $form->checkbox('name', 'value'); ?></td>
    </tr>
    <tr>
        <td>$form->checkbox('name', 'value', true);</td>
        <td><?= $form->checkbox('name', 'value', true); ?></td>
    </tr>
    <tr>
        <td>$form->radio('name', 'value');</td>
        <td><?= $form->radio('name', 'value'); ?></td>
    </tr>
    <tr>
        <td>$form->radio('name', 'value', true);</td>
        <td><?= $form->radio('name', 'value', true); ?></td>
    </tr>
    <tr>
        <td>$form->select('size', ['L' => 'Large', 'S' => 'Small']);</td>
        <td><?= $form->select('size', ['L' => 'Large', 'S' => 'Small']); ?></td>
    </tr>
    <tr>
        <td>$form->select('size', ['L' => 'Large', 'S' => 'Small'], 'L');</td>
        <td><?= $form->select('size', ['L' => 'Large', 'S' => 'Small'], 'L'); ?></td>
    </tr>
    <tr>
        <td>
            $form->select('animal', [
                    'Cats' => ['leopard' => 'Leopard'],
                    'Dogs' => ['spaniel' => 'Spaniel'],
                ]);
        </td>
        <td>
            <?=
            $form->select('animal', [
                    'Cats' => ['leopard' => 'Leopard'],
                    'Dogs' => ['spaniel' => 'Spaniel'],
                ]);
            ?>
        </td>
    </tr>
    <tr>
        <td>$form->selectRange('number', 10, 20);</td>
        <td><?= $form->selectRange('number', 10, 20); ?></td>
    </tr>
    <tr>
        <td>$form->selectMonth('month');</td>
        <td><?= $form->selectMonth('month'); ?></td>
    </tr>
    <tr>
        <td>$form->submit('Click Me!');</td>
        <td><?= $form->submit('Click Me!'); ?></td>
    </tr>
    <tr>
        <td>$form->token();</td>
        <td><?= $form->token();?></td>
    </tr>
    <tr>
        <td>$form->label('email', 'E-Mail Address');</td>
        <td><?= $form->label('email', 'E-Mail Address');?></td>
    </tr>
    <tr>
        <td>$form->label('email', 'e-Mail Address', ['class' => 'awesome']);</td>
        <td><?= $form->label('email', 'e-Mail Address', ['class' => 'awesome']);?></td>
    </tr>

    <tr>
        <td>$form->open(['url' => 'foo/bar'])</td>
        <td>
            <?php
                echo $form->open(['url' => 'foo/bar']);
                echo $form->close();
            ?>
        </td>
    </tr>
    <tr>
        <td>$form->open(['url' => 'foo/bar', 'method' => 'put')];</td>
        <td>
            <?php
                echo $form->open(['url' => 'foo/bar', 'method' => 'put']);
                echo $form->close();
            ?>
        </td>
    </tr>
    <tr>
        <td>$form->close()</td>
        <td></td>
    </tr>
</table>