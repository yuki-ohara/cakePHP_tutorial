<!-- app/View/Groups/index.ctp -->

<h1>Groups</h1>
    <p><?php echo $this->Html->link('Add Group', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

    <?php foreach ($groups as $group): ?>
        <tr>
            <td><?php echo $group['Group']['id']; ?></td>
            <td>
                <?php
                    echo $this->Html->link(
                        $group['Group']['name'],
                        array('action' => 'view', $group['Group']['id'])
                    );
                ?>
            </td>
            <td>
                <?php
                    echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $group['Group']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                ?>
                <?php
                    echo $this->Html->link(
                        'Edit', array('action' => 'edit', $group['Group']['id'])
                    );
                ?>
            </td>
            <td>
                <?php echo $group['Group']['created']; ?>
            </td>
        </tr>
        <?php endforeach; ?>

</table>