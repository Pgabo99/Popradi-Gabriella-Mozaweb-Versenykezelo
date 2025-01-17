# Popradi-Gabriella-Mozaweb-Versenykezelo

# About

Guest permission:
  Login
  Register

Users permissions:
  Update, Delete their Profile
  Join different Rounds

Admins permissions:
  Create, Read, Update, Delete Competitions
  Create, Read, Update, Delete Rounds
  Create, Read, Update, Delete Competitors
  
Admin: admin@admin.com password: Admin123

# How do I run this?

1. Start XAMPP
2. Start MySQL
3. Start Apache
4. Create a competition_manager table
5. Pull git repository
6. Enter the competition-manager folder 
7. php artisan migrate
8. php artisan db:seed --class=UserSeeder
9. php artisan db:seed --class=CompetitionsSeeder
10. php artisan db:seed --class=RoundsSeeder
11. php artisan db:seed --class=CompetitorsSeeder
12. php artisan serve
13. Click on the link
