import sys
import glob

layout_files = glob.glob(r'c:\Users\Salmon\Desktop\struktur mgmp\laravel\resources\views\**\*.blade.php', recursive=True)
for file_path in layout_files:
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        new_content = content.replace('Logo Mgmp PKK jabar.jpeg', 'Logo_Mgmp_PKK_jabar-removebg-preview.png')
        
        if new_content != content:
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f"Replaced in {file_path}")
    except Exception as e:
        print(f"Error in {file_path}: {e}")
