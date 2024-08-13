@foreach($items as $item)
<tr>
    <td>{{ $item->reference}}</td>
</tr>
@endforeach


while ($row = mysqli_fetch_assoc($result)) {

        $reference = $row['reference'];

        if ($row['status'] === 'RELEASED') {
            if ($row['fin_date']) {
                $deyt1 = $row['deyt'];
                $deyt2 = $row['fin_date'];
                $givenDate = new DateTime($deyt1);
                $currentDate = new DateTime($deyt2);

                $interval = $currentDate->diff($givenDate);

                $days = $interval->days;
                $hours = $interval->h;
                $minutes = $interval->i;

                if ($days > 0) {
                    $deyt = $days . 'D - ' . $hours . 'H - ' . $minutes . 'M';
                } else if ($hours > 0) {
                    $deyt = $hours . 'H - ' . $minutes . 'M';
                } else {
                    $deyt = $minutes . 'M';
                }
            } else {
                $deyt = $row['deyt'];
                $givenDate = new DateTime($deyt);
                $currentDate = new DateTime();

                $interval = $currentDate->diff($givenDate);

                $days = $interval->days;
                $hours = $interval->h;
                $minutes = $interval->i;

                if ($days > 0) {
                    $deyt = $days . 'D - ' . $hours . 'H - ' . $minutes . 'M';
                } else if ($hours > 0) {
                    $deyt = $hours . 'H - ' . $minutes . 'M';
                } else {
                    $deyt = $minutes . 'M';
                }
            }
        } else {
            $deyt = $row['deyt'];
            $givenDate = new DateTime($deyt);
            $currentDate = new DateTime();

            $interval = $currentDate->diff($givenDate);

            $days = $interval->days;
            $hours = $interval->h;
            $minutes = $interval->i;

            if ($days > 0) {
                $deyt = $days . 'D - ' . $hours . 'H - ' . $minutes . 'M';
            } else if ($hours > 0) {
                $deyt = $hours . 'H - ' . $minutes . 'M';
            } else {
                $deyt = $minutes . 'M';
            }
        }

        $entity = $row['entity'];
        $requested_by = $row['requested_by'];
        $status = $row['status'];
        if ($status) {

        } else {
            $status = 'PENDING';
        }
        $total = $row['total'];

        echo'
        <tr>
            <th>'. $reference .'</th>
            <th>'. $deyt .'</th>
            <th>'. $entity .'</th>
            <th>'. $requested_by .'</th>
        ';
        if ($status === 'PENDING') {
            echo'
                <th><small class="text-warning">'. $status .'</small></th>
            ';
        } else if ($status === 'TO RETURN') {
            echo'
                <th><small style="color: #BA16BA;">'. $status .'</small></th>
            ';
        } else if ($status === 'HOLD') {
            echo'
                <th><small class="text-primary">'. $status .'</small></th>
            ';
        } else if ($status === 'TO PROCESS') {
            echo'
                <th><small class="text-danger">'. $status .'</small></th>
            ';
        } else if ($status === 'PROCESSING') {
            echo'
                <th><small style="color: #CB6015;">'. $status .'</small></th>
            ';
        } else if ($status === 'FOR FUNDING') {
            echo'
                <th><small style="color: #05C3DD;">'. $status .'</small></th>
            ';
        } else if ($status === 'RELEASED') {
            echo'
                <th><small class="text-success">'. $status .'</small></th>
            ';
        }
        echo'
            <th>₱'. $total .'</th>
            <th>
                <button onclick="view_my_request('. $row['id'] .');" type="button" class="btn btn-sm btn-outline-danger rounded-0 w-100" style="margin: 0 5px 5px 0;">View</button>
            </th>
        </tr>
        ';

    }