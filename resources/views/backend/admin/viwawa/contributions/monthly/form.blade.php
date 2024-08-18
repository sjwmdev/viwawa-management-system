<!-- All css -->
@include('backend.components.form.allcss')

@if (Route::currentRouteName() == 'admin.monthly.contributions.create')
    <div class="form-group">
        <label for="contribution_type">Aina ya Mchango</label>
        <input type="text" name="contribution_type_name" id="contribution_type" class="form-control"
            value="Mchango wa Mwezi" disabled>
        <input type="hidden" name="contribution_type_id" value="{{ $contributionTypeId }}">
    </div>
@else
    <div class="form-group">
        <label for="contribution_type">Aina ya Mchango</label>
        <select name="contribution_type_id" id="contribution_type" class="form-control" required>
            @foreach ($contributionTypes as $contributionType)
                <option value="{{ $contributionType->id }}"
                    {{ isset($contribution) && $contribution->contribution_type == $contributionType->id ? 'selected' : '' }}>
                    {{ ucwords($contributionType->name) }} (Lengo: {{ $contributionType->goal_amount }})
                </option>
            @endforeach
        </select>
    </div>
@endif

<div class="form-group">
    <label for="member_id">Mwanachama</label>
    <select name="member_id" id="member_id" class="form-control select2" required>
        @foreach ($members as $member)
            <option value="{{ $member->id }}"
                {{ isset($contribution) && $contribution->member_id == $member->id ? 'selected' : '' }}>
                {{ $member->user->full_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="paid_amount">Kiasi Kilicholipwa</label>
    <input type="number" name="paid_amount" id="paid_amount" class="form-control"
        value="{{ old('paid_amount', $contribution->paid_amount ?? '') }}" required>
</div>

<div class="form-group">
    <label for="goal_amount">Kiasi cha Lengo</label>
    <input type="number" name="goal_amount" id="goal_amount" class="form-control" value="{{ $goalAmount }}" disabled>
</div>

<div class="form-group mb-4">
    <label for="date">Tarehe</label>
    @if (Route::currentRouteName() == 'admin.monthly.contributions.edit')
        <input type="date" name="date" id="date" class="form-control"
            value="{{ old('date', \Carbon\Carbon::parse($contribution->date)->format('Y-m-d') ?? '') }}" required>
    @else
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
    @endif
</div>

<!-- All js -->
@include('backend.components.form.alljs')
