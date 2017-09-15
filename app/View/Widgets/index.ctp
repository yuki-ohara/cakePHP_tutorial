<!-- app/View/Widgets/index.ctp -->

<h1>Widgets</h1>
    <p><?php echo $this->Html->link('Add Widget', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Part No</th>
        <th>Quantity</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

    <?php foreach ($widgets as $widget): ?>
        <tr>
            <td><?php echo $widget['Widget']['id']; ?></td>
            <td>
                <?php
                    echo $this->Html->link(
                        $widget['Widget']['name'],
                        array('action' => 'view', $widget['Widget']['id'])
                    );
                ?>
            </td>
            <td>
                <?php
                    echo $widget['Widget']['part_no'];
                ?>
            </td>
            <td>
                <?php
                    echo $widget['Widget']['quantity'];
                ?>
            </td>
            <td>
                <?php
                    echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $widget['Widget']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                ?>
                <?php
                    echo $this->Html->link(
                        'Edit', array('action' => 'edit', $widget['Widget']['id'])
                    );
                ?>
            </td>
            <td>
                <?php echo $widget['Widget']['created']; ?>
            </td>
        </tr>
        <?php endforeach; ?>

</table>