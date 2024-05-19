@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Buat Voting Baru</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('votings.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="NAMA_VOTING">Nama Voting</label>
                            <input type="text" class="form-control @error('NAMA_VOTING') is-invalid @enderror" id="NAMA_VOTING" name="NAMA_VOTING" value="{{ old('NAMA_VOTING') }}" required>
                            @error('NAMA_VOTING')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="DESKRIPSI_VOTING">Deskripsi Voting</label>
                            <textarea class="form-control @error('DESKRIPSI_VOTING') is-invalid @enderror" id="DESKRIPSI_VOTING" name="DESKRIPSI_VOTING" rows="3" required>{{ old('DESKRIPSI_VOTING') }}</textarea>
                            @error('DESKRIPSI_VOTING')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="MULAI_VOTING">Tanggal Mulai Voting</label>
                            <input type="date" class="form-control @error('MULAI_VOTING') is-invalid @enderror" id="MULAI_VOTING" name="MULAI_VOTING" value="{{ old('MULAI_VOTING') }}" required>
                            @error('MULAI_VOTING')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="SELESAI_VOTING">Tanggal Selesai Voting</label>
                            <input type="date" class="form-control @error('SELESAI_VOTING') is-invalid @enderror" id="SELESAI_VOTING" name="SELESAI_VOTING" value="{{ old('SELESAI_VOTING') }}" required>
                            @error('SELESAI_VOTING')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" id="candidates">
                            <label for="candidates">Calon</label>
                            <button type="button" class="btn btn-sm m-md-6 btn-secondary addCandidate">Tambah Calon</button>
<!--                             <div class="candidate-group">
                                <select class="form-control mb-2" name="candidates[]">
                                    <option value="" selected disabled>Pilih Calon</option>
                                    @foreach($calonList as $calon)
                                        <option value="{{ $calon->ID_CALON }}">{{ $calon->KETUA_CALON }}</option>
                                    @endforeach
                                </select>
                            </div> -->
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

    // Function to check if all candidates have been selected
    function allCandidatesSelected() {
        var allSelected = true;
        $('select[name="candidates"]').each(function() {
            if (!$(this).val()) {
                allSelected = false;
                return false; // Exit loop early if any candidate is not selected
            }
        });
        return allSelected;
    }

    function toggleAddCandidateButton() {
        if (allCandidatesSelected()) {
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
