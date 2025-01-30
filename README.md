https://www.creative-tim.com/product/argon-dashboard

Need to implement:
    Add validation in edit form, also email unique validation for create, edit user 
    Add back button in needed place
    Created Details page for user
    

    in Eloquent method the validation is same or not ???

    
    in the code the $input variable is same or not (in update class)
        // Query builder method
        $input = Arr::only($request->all(), ['name', 'email']);
        $user = DB::table('users')
            ->where('id', $id)
            ->update($input);

            // Eloquent method
            