<div class="card-body">
    
    <form class="row" wire:submit.prevent='login'>
        <div class="col-md-12 mb-3">
            
            <h2>Sign In</h2>
            <p>Enter your email and password to login</p>
            
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" wire:model='email'>
                @error('email')
                <div class="feedback text-danger">
                    Please provide an email.
                </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" wire:model='password'>
                @error('password')
                <div class="feedback text-danger">
                    Please provide a valid password.
                </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-check-primary form-check-inline">
                    <input class="form-check-input me-3" type="checkbox" id="form-check-default" wire:model="remember">
                    <label class="form-check-label" for="form-check-default">Remember me</label>
                </div>
            </div>
        </div>
        
        <div class="col-12">
            <div class="mb-4">
                <button class="btn btn-secondary w-100"><x-spinner/>SIGN IN</button>
            </div>
        </div>
       

    </form>
    
</div>