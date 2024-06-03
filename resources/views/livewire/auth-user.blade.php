<div>
    @if(auth()->check())
        <h5>Apakah anda ingin logout ?</h5>
        <div class="action_btns mt-4">
            <div class="one_half"><button wire:click="logout" class="btn btn_red">Logout</button></div>
        </div>
    @else
        <form wire:submit.prevent="submit" id='form-auth'>
            @if(session()->has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <label>Username</label>
            <input type="text" wire:model="username" />
            @error('username')
                <code>{{ $message }}</code>
            @enderror
            <br />

            <label>Password</label>
            <input type="password" wire:model="password" />
            @error('password')
                <code>{{ $message }}</code>
            @enderror
            <br />
            <div class="action_btns">
                <div class="one_half"><button type="submit" class="btn btn_red">Login</button></div>
            </div>
        </form>
    @endif
</div>
