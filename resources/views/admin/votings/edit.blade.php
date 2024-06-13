@extends('layouts.app')

@section('content')
<div class="mb-5">
    @if(session('success'))
        <div id="alert" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
          <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <span class="sr-only">Success</span>
          <div class="ms-3 text-sm font-medium">
            {{ session('success') }}
          </div>
          <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
          </button>
        </div>
    @endif
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Voting</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('votings.update', $voting->ID_VOTING) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="NAMA_VOTING">Nama Voting</label>
                            <input type="text" class="form-control @error('NAMA_VOTING') is-invalid @enderror" id="NAMA_VOTING" name="NAMA_VOTING" value="{{ $voting->NAMA_VOTING }}" required>
                            @error('NAMA_VOTING')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="DESKRIPSI_VOTING">Deskripsi Voting</label>
                            <textarea class="form-control @error('DESKRIPSI_VOTING') is-invalid @enderror" id="DESKRIPSI_VOTING" name="DESKRIPSI_VOTING" rows="3" required>{{ $voting->DESKRIPSI_VOTING }}</textarea>
                            @error('DESKRIPSI_VOTING')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="MULAI_VOTING">Tanggal Mulai Voting</label>
                            <input type="date" class="form-control @error('MULAI_VOTING') is-invalid @enderror" id="MULAI_VOTING" name="MULAI_VOTING" value="{{ $voting->MULAI_VOTING }}" required>
                            @error('MULAI_VOTING')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="SELESAI_VOTING">Tanggal Selesai Voting</label>
                            <input type="date" class="form-control @error('SELESAI_VOTING') is-invalid @enderror" id="SELESAI_VOTING" name="SELESAI_VOTING" value="{{ $voting->SELESAI_VOTING }}" required>
                            @error('SELESAI_VOTING')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Isi dengan form untuk memilih calon -->
                        <div class="form-group" id="candidates">
                            <label for="candidates">Calon</label>
                            <button type="button" class="btn btn-sm m-md-6 btn-secondary addCandidate">Tambah Calon</button>
                            <!-- Tampilkan calon yang sudah dipilih -->
                            @foreach($voting->calonVotings as $calonVoting)
                            <div class="candidate-group">
                                <select class="form-control mb-2" name="candidates[]">
                                    <option value="" selected disabled>Pilih Calon</option>
                                    @foreach($calonList as $calon)
                                        <option value="{{ $calon->ID_CALON }}" {{ $calonVoting->ID_CALON == $calon->ID_CALON ? 'selected' : '' }}>{{ $calon->KETUA_CALON }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-sm btn-danger removeCandidate">Hapus</button>
                            </div>
                            @endforeach
                            @error('candidates')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    var selectedCandidates = [];

    function toggleAddCandidateButton() {
        var allCandidatesSelected = true;
        $('select[name="candidates[]"]').each(function() {
            if (!$(this).val()) {
                allCandidatesSelected = false;
                return false; // Keluar dari loop jika ada calon yang belum dipilih
            }
        });

        if ($('select[name="candidates[]"]').last().find('option:enabled').length > 1) {
            allCandidatesSelected = true;
        }

        if (allCandidatesSelected) {
            $('.addCandidate').show();
        } else {
            $('.addCandidate').hide();
        }
    }

    toggleAddCandidateButton();

    $('select[name="candidates[]"]').each(function() {
        var selectedCandidateId = $(this).val();
        if (selectedCandidateId) {
            selectedCandidates.push(selectedCandidateId);
        }
    });

    $('.addCandidate').click(function() {
        var candidateGroup = '<div class="candidate-group"><select class="form-control mb-2" name="candidates[]"><option value="" selected disabled>Pilih Calon</option>';
        @foreach($calonList as $calon)
            var candidateId = "{{ $calon->ID_CALON }}";
            var candidateName = "{{ $calon->KETUA_CALON }}";
            if (!selectedCandidates.includes(candidateId)) {
                candidateGroup += '<option value="' + candidateId + '">' + candidateName + '</option>';
            }
        @endforeach
        candidateGroup += '</select><button type="button" class="btn btn-sm btn-danger removeCandidate">Hapus</button></div>';
        $('#candidates').append(candidateGroup);
        toggleAddCandidateButton();
    });


    $(document).on('click', '.removeCandidate', function() {
        var removedCandidateId = $(this).siblings('select').val();
        selectedCandidates = selectedCandidates.filter(function(id) {
            return id !== removedCandidateId;
        });
        $(this).closest('.candidate-group').remove();
        toggleAddCandidateButton();
    });

    $(document).on('change', 'select[name="candidates[]"]', function() {
        var numOfCandidates = $('select[name="candidates[]"]').last().find('option:enabled').length;
        if (numOfCandidates > 1) {
            toggleAddCandidateButton();
        } else {
            $('.addCandidate').hide();
        }
        var selectedCandidateId = $(this).val();
        if (!selectedCandidates.includes(selectedCandidateId)) {
            selectedCandidates.push(selectedCandidateId);
        }
    });
});

</script>
@endsection
