<!DOCTYPE html>
<html>
<head>
    <title>Daftar Role</title>
</head>
<body>
    <h2>Daftar Role</h2>
    <a href="{{ route('roles.create') }}">Tambah Role</a>
    <ul>
        @foreach($roles as $role)
            <li>{{ $role->nama }} - {{ $role->email }} - {{ $role->no_hp }}
                @if($role->parentRole)
                    (Induk: {{ $role->parentRole->nama }})
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
