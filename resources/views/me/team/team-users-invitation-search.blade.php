@if (count($users)>0)
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Invitar</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($users as $key=> $item)
      <tr>
        <th scope="row">{{ $key+1 }}</th>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td> <a href="{{ route('sendInvitation', [ 'id'=> $team->id, 'user_id'=> $item->id ]) }}" class="btn btn-success"><i class="far fa-paper-plane"></i></a> </td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
@endif