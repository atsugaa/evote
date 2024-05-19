import pandas as pd

# Membaca file Excel tanpa mengetahui nama kolomnya
df = pd.read_excel('data1.xlsx', header=None)

# Fungsi untuk menambahkan 2 nol di depan nilai numerik jika panjangnya kurang dari 10 digit
def add_leading_zeros(x):
    if isinstance(x, int):
        return f'{x:010}'
    else:
        return x

# Menambahkan 2 nol di depan nilai-nilai yang memiliki panjang kurang dari 10 digit
df[2] = df[2].apply(add_leading_zeros)

# Mengonversi DataFrame menjadi list
mylist = df.values.tolist()

# Mencetak list
print(mylist)
