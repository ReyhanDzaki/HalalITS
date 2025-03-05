<div class="mx-12 mt-4">
    @if (session()->has('message'))
        <div class="p-4 my-4 text-white bg-green-500">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4 w-[60%]">
        <input type="text" wire:model.live="search" placeholder="Search UMKM..." class="border p-2 rounded w-full">
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border">UMKM Name</th>
                <th class="py-2 px-4 border">Owner</th>
                <th class="py-2 px-4 border">Assigned User</th>
                <th class="py-2 px-4 border">Assign User</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($umkms as $umkm)
                <tr>
                    <td class="py-2 px-4 border">{{ $umkm->nama_umkm }}</td>
                    <td class="py-2 px-4 border">{{ $umkm->nama_pemilik }}</td>
                    <td class="py-2 px-4 border">
                        {{ $umkm->user ? $umkm->user->name : 'Not Assigned' }}
                    </td>
                    <td class="py-2 px-4 border">
                        <select wire:change="assignUser('{{ $umkm->no_umkm }}', $event.target.value)"
                            class="border rounded">
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $umkm->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="py-2 px-4 border">
                        @if ($umkm->user)
                            <button wire:click="deleteUser('{{ $umkm->no_umkm }}')"
                                class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded">
                                Remove User
                            </button>
                        @else
                            <span class="text-gray-500">No User Assigned</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
