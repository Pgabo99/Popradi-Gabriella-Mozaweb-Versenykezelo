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
2. Start mySQL
3. Create a competition_manager table
4. Pull git repository
5. Enter the competition-manager folder 
6. php artisan migrate
7. php artisan db:seed --class=UserSeeder
8. php artisan db:seed --class=CompetitionsSeeder
9. php artisan db:seed --class=RoundsSeeder
10. php artisan db:seed --class=CompetitorsSeeder
11. php artisan serve
12. Click on the link
