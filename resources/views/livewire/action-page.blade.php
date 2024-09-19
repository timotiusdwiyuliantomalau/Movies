<div>
    <div class="flex gap-5 self-center font-semibold cursor-pointer">
        <button wire:click="recommendedPage" class="{{ $page=="recommended"?'bg-yellow-500 text-black rounded-full p-2 font-bold':'text-yellow-500 rounded-full p-2 font-bold' }}">Recommended</button>
        <button wire:click="top_ratedPage" class="{{ $page=="top_rated"?'bg-yellow-500 text-black rounded-full p-2 font-bold':'text-yellow-500 rounded-full p-2 font-bold' }}">Top Rated</button>
        <button wire:click="genresPage" class="{{ $page=="genres"?'bg-yellow-500 text-black rounded-full p-2 font-bold':'text-yellow-500 rounded-full p-2 font-bold' }}">Genres</button>
    </div>
    
</div>
