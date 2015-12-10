<h1> Paginate Your Data </h1>
<table>
    <tr>
        <td>Date</td>
        <td>Type</td>
        <td>Objet</td>
    </tr>
<?

/* Display the list of data for the current page supplied by the controller */

foreach ($data as $item) {
    echo '<tr>';

    echo '<td>' . $item['Consultation']['date'] . '</td>';
    if ($item['Consultation']['is_detail']==1) {
        echo '<td>Detail</td>';
    } else {
        echo '<td>Recherche</td>';
    }
    echo '<td>';
    echo ($item['Cepage']['label']!= null) ? $item['Cepage']['label'].' ' : '';
    echo ($item['Origine']['label']!= null) ? $item['Origine']['label'] : '';
    echo '</td>';
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