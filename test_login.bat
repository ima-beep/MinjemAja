@echo off
REM Test login guru
echo === TEST LOGIN GURU ===
curl -i -X POST http://127.0.0.1:8000/login ^
  -H "Content-Type: application/x-www-form-urlencoded" ^
  -d "email=guru@test.com&password=password&role=teacher&_token=test" ^
  -c cookies.txt

echo.
echo === TEST LOGIN SISWA ===
curl -i -X POST http://127.0.0.1:8000/login ^
  -H "Content-Type: application/x-www-form-urlencoded" ^
  -d "email=siswa@test.com&password=password&role=student&_token=test" ^
  -c cookies2.txt
