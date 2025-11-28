@extends('layouts.app')

@section('title', 'Edit Profile - SMM AUTO GALLERY')

@section('content')
<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div class="profile-header" style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: bold; color: #1a1a1a; margin-bottom: 0.5rem;">Profile Settings</h1>
        <p style="color: #666;">Manage your account information and security settings</p>
    </div>

    <div style="display: grid; gap: 2rem;">
        <!-- Update Profile Information -->
        <div class="card" style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div style="margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem;">
                    Profile Information
                </h2>
                <p style="color: #666; font-size: 0.875rem;">
                    Update your account's profile information and email address.
                </p>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div style="margin-bottom: 1.5rem;">
                    <label for="name" style="display: block; font-weight: 500; color: #333; margin-bottom: 0.5rem;">
                        Name
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $user->name) }}" 
                        required 
                        autofocus
                        class="form-input"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;"
                    >
                    @error('name')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; font-weight: 500; color: #333; margin-bottom: 0.5rem;">
                        Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}" 
                        required
                        class="form-input"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;"
                    >
                    @error('email')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div style="margin-top: 1rem; padding: 1rem; background: #fef3c7; border-radius: 4px;">
                            <p style="color: #92400e; font-size: 0.875rem;">
                                Your email address is unverified.
                                <button 
                                    type="submit" 
                                    form="send-verification"
                                    style="color: #dc2626; text-decoration: underline; background: none; border: none; cursor: pointer;"
                                >
                                    Click here to re-send the verification email.
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p style="color: #15803d; font-size: 0.875rem; margin-top: 0.5rem;">
                                    A new verification link has been sent to your email address.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div style="display: flex; align-items: center; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p style="color: #15803d; font-size: 0.875rem;">
                            ✓ Saved successfully
                        </p>
                    @endif
                </div>
            </form>

            <form id="send-verification" method="POST" action="{{ route('verification.send') }}" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- Update Password -->
        <div class="card" style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div style="margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem;">
                    Update Password
                </h2>
                <p style="color: #666; font-size: 0.875rem;">
                    Ensure your account is using a long, random password to stay secure.
                </p>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 1.5rem;">
                    <label for="current_password" style="display: block; font-weight: 500; color: #333; margin-bottom: 0.5rem;">
                        Current Password
                    </label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        autocomplete="current-password"
                        class="form-input"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;"
                    >
                    @error('current_password', 'updatePassword')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password" style="display: block; font-weight: 500; color: #333; margin-bottom: 0.5rem;">
                        New Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        autocomplete="new-password"
                        class="form-input"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;"
                    >
                    @error('password', 'updatePassword')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password_confirmation" style="display: block; font-weight: 500; color: #333; margin-bottom: 0.5rem;">
                        Confirm Password
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        autocomplete="new-password"
                        class="form-input"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;"
                    >
                    @error('password_confirmation', 'updatePassword')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; align-items: center; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">
                        Update Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <p style="color: #15803d; font-size: 0.875rem;">
                            ✓ Password updated successfully
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="card" style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: 1px solid #fee2e2;">
            <div style="margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; color: #dc2626; margin-bottom: 0.5rem;">
                    Delete Account
                </h2>
                <p style="color: #666; font-size: 0.875rem;">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                </p>
            </div>

            <button 
                type="button" 
                onclick="document.getElementById('deleteAccountModal').style.display='flex'"
                style="background: #dc2626; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 4px; font-weight: 500; cursor: pointer;"
            >
                Delete Account
            </button>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="deleteAccountModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 9999;">
    <div style="background: white; border-radius: 8px; padding: 2rem; max-width: 500px; width: 90%; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
        <h2 style="font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin-bottom: 1rem;">
            Are you sure you want to delete your account?
        </h2>
        
        <p style="color: #666; font-size: 0.875rem; margin-bottom: 1.5rem;">
            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div style="margin-bottom: 1.5rem;">
                <label for="delete_password" style="display: block; font-weight: 500; color: #333; margin-bottom: 0.5rem;">
                    Password
                </label>
                <input 
                    type="password" 
                    id="delete_password" 
                    name="password" 
                    placeholder="Enter your password"
                    class="form-input"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;"
                >
                @error('password', 'userDeletion')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <button 
                    type="button" 
                    onclick="document.getElementById('deleteAccountModal').style.display='none'"
                    style="background: #e5e7eb; color: #374151; padding: 0.75rem 1.5rem; border: none; border-radius: 4px; font-weight: 500; cursor: pointer;"
                >
                    Cancel
                </button>
                <button 
                    type="submit"
                    style="background: #dc2626; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 4px; font-weight: 500; cursor: pointer;"
                >
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</div>

@if ($errors->userDeletion->isNotEmpty())
<script>
    document.getElementById('deleteAccountModal').style.display = 'flex';
</script>
@endif

@push('scripts')
<script>
    // Auto-hide success messages after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successMessages = document.querySelectorAll('[style*="color: #15803d"]');
        successMessages.forEach(function(msg) {
            if (msg.textContent.includes('✓')) {
                setTimeout(function() {
                    msg.style.opacity = '0';
                    msg.style.transition = 'opacity 0.5s';
                    setTimeout(function() {
                        msg.remove();
                    }, 500);
                }, 3000);
            }
        });
    });

    // Close modal when clicking outside
    document.getElementById('deleteAccountModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script>
@endpush
@endsection
