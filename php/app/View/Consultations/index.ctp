<h1> Paginate Your Data </h1>
<table>
    <tr>
        <td>Client</td>
        <td>Date</td>
        <td>Objet</td>
    </tr>
<?

/* Display the list of data for the current page supplied by the controller */

$data = $this->getVar('data');
foreach ($data as $item) {
    echo '<tr>';

    echo '<td>' . $item['Client']['nom'] ." ".$item['Client']['prenom'].'</td>';
    echo '<td>' . $item['Consultation']['date'] . '</td>';
    /*echo '<td>' . $item['Cepage']['label'].$item['Origine']['label']. '</td>';*/
    echo '</tr>';

}

/* Use the paginator helper to display links to other pages.
    A full list of available options can be found in the CakePHP documentation:
    http://book.cakephp.org/2.0/en/core-libraries/components/pagination.html */

echo $this->Paginator->numbers(array(
        'modulus' => 4,   /* Controls the number of page links to display */
        'first' => '< First',
        'last' => 'Last >',
        'before' => ' ', 'after' => ' ')
);
