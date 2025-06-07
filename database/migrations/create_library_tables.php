<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users table (for authentication: admins, librarians, readers)
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('username')->unique()->nullable(); // Nullable for social media login
        //     $table->string('email')->unique()->nullable(); // Nullable for social media login
        //     $table->string('password')->nullable(); // Nullable for social media login
        //     $table->boolean('is_active')->default(true);
        //     $table->string('provider')->nullable(); // e.g., google, facebook
        //     $table->string('provider_id')->nullable(); // Unique ID from social media provider
        //     $table->string('provider_token')->nullable(); // Access token for social media
        //     $table->string('profile_image')->nullable(); // Path or URL to profile image
        //     $table->timestamps();
        // });

        // Roles table (for role-based permissions)
        // Schema::create('roles', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->unique(); // e.g., admin, librarian, reader
        //     $table->timestamps();
        // });

        // Permissions table (specific actions, e.g., manage_books, view_reports)
        // Schema::create('permissions', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->unique(); // e.g., manage_books, borrow_books
        //     $table->timestamps();
        // });

        // Role-User pivot table (assign roles to users)
        // Schema::create('role_user', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('role_id')->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });

        // Role-Permission pivot table (assign permissions to roles)
        // Schema::create('permission_role', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('role_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });

        // Update Authors table to link with Users
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade'); // Link to users table
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('profile')->nullable();
            $table->json('socials')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });

        // Create Categories table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., Fiction, Science
            $table->timestamps();
        });
       // Update Books table to include price and is_purchasable
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author_id')->constrained()->onDelete('restrict');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('restrict');
            $table->enum('type', ['soft', 'hard']);
            $table->integer('stock')->default(0); // Total copies/licenses
            $table->integer('available')->default(0); // Available for borrowing
            $table->string('isbn')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable(); // For soft books
            $table->string('store_location')->nullable(); // For hard books
            $table->decimal('price', 8, 2)->nullable(); // Purchase price, e.g., 29.99
            $table->boolean('is_purchasable')->default(false); // Can the book be bought?
            $table->timestamps();
        });

        // Create Book Acquisitions table
        Schema::create('book_acquisitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('restrict');
            $table->integer('quantity')->default(1);
            $table->decimal('cost', 8, 2)->nullable(); // Total cost of acquisition
            $table->enum('acquisition_type', ['purchase', 'donation', 'import'])->default('purchase');
            $table->string('supplier')->nullable(); // e.g., Publisher, Donor
            $table->dateTime('acquired_at');
            $table->string('transaction_id')->nullable(); // Payment gateway transaction ID
            $table->text('notes')->nullable(); // Additional details
            $table->timestamps();
        });



        // Create Book-Category pivot table
        Schema::create('book_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Readers table (extends users for library-specific info)
        Schema::create('readers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('reader_code')->unique(); // for QR code scanning
            $table->boolean('is_vip')->default(false); // VIP club status
            $table->date('vip_expiry')->nullable(); // VIP membership expiry
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        // Borrowings table (track borrowing and in-house reading)
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reader_id')->constrained()->onDelete('restrict');
            $table->foreignId('book_id')->constrained()->onDelete('restrict');
            $table->enum('type', ['borrow', 'read_in_house', 'online_read']); // borrow: take home, read_in_house: library use, online_read: soft book access
            $table->dateTime('borrowed_at');
            $table->dateTime('returned_at')->nullable();
            $table->dateTime('due_at'); // due date for return or online access expiry
            $table->enum('status', ['active', 'returned', 'overdue'])->default('active');
            $table->timestamps();
        });

        // Broken Books table (track damaged books)
        Schema::create('broken_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('restrict');
            $table->foreignId('reader_id')->nullable()->constrained()->onDelete('restrict'); // reader responsible, if applicable
            $table->text('damage_description');
            $table->enum('status', ['reported', 'repaired', 'discarded'])->default('reported');
            $table->dateTime('reported_at');
            $table->timestamps();
        });
        // Update Purchases table to include payment details
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reader_id')->constrained()->onDelete('restrict');
            $table->foreignId('book_id')->constrained()->onDelete('restrict');
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 8, 2);
            $table->dateTime('purchased_at');
            $table->string('file_access_url')->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('payment_method')->nullable(); // e.g., stripe, paypal, cash
            $table->string('transaction_id')->nullable(); // Payment gateway transaction ID
            $table->timestamps();
        });
        // Library Entries table (track QR code scans for entry)
        Schema::create('library_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reader_id')->constrained()->onDelete('restrict');
            $table->dateTime('entry_at');
            $table->dateTime('exit_at')->nullable();
            $table->timestamps();
        });

        // Librarian Attendance table
        Schema::create('librarian_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // librarian user
            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable();
            $table->timestamps();
        });

        // Create Book Reviews table
        Schema::create('book_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('restrict');
            $table->foreignId('reader_id')->constrained()->onDelete('restrict');
            $table->integer('rating')->default(0); // Rating out of 5
            $table->text('review')->nullable();
            $table->timestamps();
        });
        // Create Book Ratings table
        Schema::create('book_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('restrict');
            $table->foreignId('reader_id')->constrained()->onDelete('restrict');
            $table->integer('rating')->default(0); // Rating out of 5
            $table->timestamps();
        });
        // Create Book Tags table
        Schema::create('book_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('restrict');
            $table->string('tag'); // e.g., "Bestseller", "New Release"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('librarian_attendances');
        Schema::dropIfExists('library_entries');
        Schema::dropIfExists('broken_books');
        Schema::dropIfExists('borrowings');
        Schema::dropIfExists('readers');
        Schema::dropIfExists('book_category');
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('book_acquisitions');
        Schema::dropIfExists('book_reviews');
        Schema::dropIfExists('book_ratings');
        Schema::dropIfExists('book_tags');
        Schema::dropIfExists('books');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        // Schema::dropIfExists('users');
    }
};
