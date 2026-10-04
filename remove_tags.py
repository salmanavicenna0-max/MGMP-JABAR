import sys
import re

file_path = r'c:\Users\Salmon\Desktop\struktur mgmp\laravel\resources\views\profil\anggota.blade.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

pattern = r'\s*<div class=\"px-4 py-2 bg-mgmp/10 text-mgmp dark:text-blue-400 rounded-full text-sm font-bold tracking-wide uppercase shadow-sm\">\s*[\w\s&]+\s*</div>'

new_content = re.sub(pattern, '', content)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(new_content)
print('Done!')
