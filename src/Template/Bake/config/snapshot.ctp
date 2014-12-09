<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$tableMethod = $this->Migration->tableMethod($action);
$columnMethod = $this->Migration->columnMethod($action);
$indexMethod = $this->Migration->indexMethod($action);
%>
<?php
use Phinx\Migration\AbstractMigration;

class <%= $name %> extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {<% foreach ($tables as $table): %>
        <%= "\n\t\t\$table = \$this->table('$table');"; %>
<% foreach ($this->Migration->columns($table) as $column => $config): %>
        <%= "\$table->$columnMethod('" . $column . "', '" . $config['columnType'] . "', ["; %>
<% foreach ($config['options'] as $optionName => $option): %>
            <%= "'{$optionName}' => " .  $this->Migration->value($option) . ", "; %>
<% endforeach; %>
        <%= "]);"; %>
<% endforeach; %>
        <%= "\$table->$tableMethod();"; %>
<% endforeach; %>
    }
}
